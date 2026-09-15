<?php

namespace TomatoPHP\FilamentSocial\Http\Controllers;

use Exception;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use TomatoPHP\FilamentSocial\Events\SocialLogin;
use TomatoPHP\FilamentSocial\Events\SocialRegister;

class AuthController extends Controller
{
    public function provider(string $provider, Request $request): SymfonyRedirectResponse
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $currentPanel = (string) str($request->get('url'))->beforeLast('/')->afterLast('/');
        session()->put('current_panel', $currentPanel);

        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $exception) {
            Notification::make()
                ->title('Error')
                ->body($exception->getMessage())
                ->danger()
                ->send();

            return redirect()->to($request->get('url'));
        }
    }

    public function callback(string $provider): RedirectResponse
    {
        $panel = Filament::getPanel(session('current_panel'));

        try {
            $providerToken = config('services.'.$provider.'.client_token');

            try {
                $socialUser = $providerToken
                    ? Socialite::driver($provider)->userFromToken($providerToken)
                    : Socialite::driver($provider)->user();
            } catch (Exception $exception) {
                Notification::make()
                    ->title('Oh No!')
                    ->body("You don't have any account please register first!")
                    ->danger()
                    ->send();

                return redirect()->to(config('filament-social.panel').'/register');
            }

            $authModel = config('auth.providers.'.config('auth.guards.'.$panel->getAuthGuard().'.provider').'.model');

            $user = $authModel::query()
                ->whereHas('socialAuthUser', function ($query) use ($socialUser, $provider) {
                    $query->where('provider', $provider)->where('provider_id', $socialUser->getId());
                })
                ->first();

            if ($user) {
                $this->syncProfile($user, $socialUser);
                $this->syncSocialAccount($user, $provider, $socialUser);
            } else {
                $user = $authModel::query()->where('email', $socialUser->getEmail())->first();

                if ($user) {
                    $this->syncProfile($user, $socialUser);
                    $this->syncSocialAccount($user, $provider, $socialUser);

                    Event::dispatch(new SocialLogin($user->toArray()));
                } else {
                    $user = $authModel::create([
                        'email' => $socialUser->getEmail(),
                        'name' => $socialUser->getName(),
                        'password' => bcrypt(Str::random(32)),
                    ]);

                    $this->syncProfile($user, $socialUser);
                    $this->syncSocialAccount($user, $provider, $socialUser);

                    if (config('filament-social.notification.discord') && Notification::hasMacro('sendToDiscord')) {
                        Notification::make()
                            ->title('New User Registered')
                            ->body(collect([
                                'NAME: '.$user->name,
                                'EMAIL: '.$user->email,
                            ])->implode("\n"))
                            ->sendToDiscord();
                    }

                    Event::dispatch(new SocialRegister($user->toArray()));
                }
            }

            auth($panel->getAuthGuard())->login($user);

            Notification::make()
                ->title('Welcome '.$user->name)
                ->body('You have successfully logged in!')
                ->success()
                ->send();

            return redirect()->to(config('filament-social.panel'));
        } catch (Exception $exception) {
            report($exception);

            Notification::make()
                ->title('Error')
                ->body('Something went wrong!')
                ->danger()
                ->send();

            return redirect()->to(config('filament-social.panel'));
        }
    }

    protected function syncProfile(Model $user, SocialiteUser $socialUser): void
    {
        $attributes = ['name' => $socialUser->getName() ?: $user->name];

        if (Schema::hasColumn($user->getTable(), 'username') && blank($user->username)) {
            $username = (string) Str::of($socialUser->getNickname() ?: $socialUser->getName())->slug('_');

            if ($user->newQuery()->where('username', $username)->whereKeyNot($user->getKey())->exists()) {
                $username .= '_'.$socialUser->getId();
            }

            $attributes['username'] = $username;
        }

        if (Schema::hasColumn($user->getTable(), 'profile_photo_path') && filled($socialUser->getAvatar())) {
            $attributes['profile_photo_path'] = $socialUser->getAvatar();
        }

        $user->forceFill($attributes)->save();
    }

    protected function syncSocialAccount(Model $user, string $provider, SocialiteUser $socialUser): void
    {
        $user->socialAuthUser()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ],
            [
                'data' => [
                    'id' => $socialUser->getId(),
                    'nickname' => $socialUser->getNickname(),
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar(),
                ],
            ],
        );
    }
}
