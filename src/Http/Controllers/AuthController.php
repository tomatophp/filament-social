<?php

namespace TomatoPHP\FilamentSocial\Http\Controllers;

use App\Http\Controllers\Controller;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use TomatoPHP\FilamentAccounts\Models\AccountsMeta;
use TomatoPHP\FilamentAlerts\Services\SendNotification;
use TomatoPHP\FilamentDiscord\Jobs\NotifyDiscordJob;
use TomatoPHP\FilamentSocial\Events\SocialLogin;
use TomatoPHP\FilamentSocial\Events\SocialRegister;

class AuthController extends Controller
{
    public function provider($provider, Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);


        $currentPanel = str($request->get('url'))->beforeLast('/')->afterLast('/');
        session()->put('current_panel', $currentPanel);

        try {
            return Socialite::driver($provider)
                ->redirect();
        }catch (\Exception $exception){
            Notification::make()
                ->title('Error')
                ->body($exception->getMessage())
                ->danger()
                ->send();

            return redirect()->to($request->get('url'));
        }
    }

    public function callback($provider)
    {
        $getFilamentPanel = Filament::getPanel(session('current_panel'));

        try {
            $providerHasToken = config('services.'.$provider.'.client_token');
            try {
                if($providerHasToken){
                    $socialUser = Socialite::driver($provider)->userFromToken($providerHasToken);
                }
                else {
                    $socialUser = Socialite::driver($provider)->user();
                }
            }catch (\Exception $exception){
                Notification::make()
                    ->title('Oh No!')
                    ->body("You don't have any account please register first!")
                    ->danger()
                    ->send();

                return redirect()->to(config('filament-social.panel') . '/register');
            }

            $getAuthModel = config('auth.providers.' . config('auth.guards.'.$getFilamentPanel->getAuthGuard().'.provider') . '.model');
            $user = $getAuthModel::query()->whereHas('socialAuthUser', function ($query) use ($socialUser, $provider) {
                $query->where('provider', $provider)->where('provider_id', $socialUser->id);
            })->first();

            if(!$user){
                $user = $getAuthModel::query()->where('email', $socialUser->email)->first();
                if(!$user){
                    $user = $getAuthModel::create([
                        'email' => $socialUser->email,
                        'name' => $socialUser->name,
                        'password' => bcrypt(Str::random(10)),
                    ]);

                    if(Schema::hasColumn($user->getTable(), 'username')){
                        if(isset($socialUser->attributes['nickname'])){
                            $id = str($socialUser->attributes['nickname'])->slug('_');
                        }
                        else {
                            $id = Str::of($socialUser->name)->slug('_')->toString();
                        }

                        $user->update([
                            'username' => $id
                        ]);
                    }

                    if(Schema::hasColumn($user->getTable(), 'profile_photo_path')){
                        $user->update([
                            'profile_photo_path' => $socialUser->avatar
                        ]);
                    }

                    $user->socialAuthUser()->create([
                        'provider' => $provider,
                        'provider_id' => $socialUser->id,
                        'data' => $socialUser
                    ]);


                    if(config('filament-social.notification.discord')){
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
                else {
                    $user->update([
                        'name' => $socialUser->name,
                        'data' => $socialUser
                    ]);

                    if(Schema::hasColumn($user->getTable(), 'username')){
                        if(isset($socialUser->attributes['nickname'])){
                            $id = str($socialUser->attributes['nickname'])->slug('_');
                        }
                        else {
                            $id = Str::of($socialUser->name)->slug('_')->toString();
                        }

                        $user->update([
                            'username' => $id
                        ]);
                    }

                    if(Schema::hasColumn($user->getTable(), 'profile_photo_path')){
                        $user->update([
                            'profile_photo_path' => $socialUser->avatar
                        ]);
                    }

                    Event::dispatch(new SocialLogin($user->toArray()));
                }
            }
            else {
                $user->update([
                    'name' => $socialUser->name,
                    'data' => $socialUser
                ]);

                if(Schema::hasColumn($user->getTable(), 'username')){
                    if(isset($socialUser->attributes['nickname'])){
                        $id = str($socialUser->attributes['nickname'])->slug('_');
                    }
                    else {
                        $id = Str::of($socialUser->name)->slug('_')->toString();
                    }

                    $user->update([
                        'username' => $id
                    ]);
                }

                if(Schema::hasColumn($user->getTable(), 'profile_photo_path')){
                    $user->update([
                        'profile_photo_path' => $socialUser->avatar
                    ]);
                }
            }

            auth($getFilamentPanel->getAuthGuard())->login($user);

            Notification::make()
                ->title('Welcome '. $user->name)
                ->body('You have successfully logged in!')
                ->success()
                ->send();

            return redirect()->to(config('filament-social.panel'));
        }
        catch (\Exception $exception){
            Notification::make()
                ->title('Error')
                ->body('Something went wrong!')
                ->danger()
                ->send();
            return redirect()->to(config('filament-social.panel'));
        }
    }
}
