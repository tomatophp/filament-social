<?php

namespace TomatoPHP\FilamentSocial\Http\Controllers;

use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use TomatoPHP\FilamentAccounts\Models\AccountsMeta;
use TomatoPHP\FilamentAlerts\Services\SendNotification;
use TomatoPHP\FilamentDiscord\Jobs\NotifyDiscordJob;

class AuthController extends Controller
{
    public function provider($provider)
    {
        try {
            return Socialite::driver($provider)
                ->redirect();
        }catch (\Exception $exception){
            Notification::make()
                ->title('Error')
                ->body('Something went wrong!')
                ->danger()
                ->send();

            return redirect()->to('app/login');
        }
    }

    public function callback($provider)
    {
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

                return redirect()->to(app()->getLocale() . '/register');
            }

            if(isset($socialUser->attributes['nickname'])){
                $id = str($socialUser->attributes['nickname'])->slug('_');
            }
            else {
                $id = \Str::of($socialUser->name)->slug('_')->toString();
            }

            $user = Account::query()->whereHas('accountsMetas', function ($query) use ($socialUser, $provider) {
                $query->where('key', $provider)->where('value', $socialUser->id);
            })->first();

            if(!$user){
                $user = Account::query()->where('email', $socialUser->email)->first();
                if(!$user){
                    $user = Account::create([
                        'email' => $socialUser->email,
                        'name' => $socialUser->name,
                        'username' => $id,
                        'otp_activated_at' => Carbon::now(),
                        'is_active' => true,
                    ]);

                    $user->meta($provider, $socialUser->id);

                    Notification::make()
                        ->title('New TomatoPHP User')
                        ->body(collect([
                            'NAME: '.$user->name,
                            'EMAIL: '.$user->email,
                            'PHONE: '.$user->phone,
                            'USERNAME: '.$user->username,
                        ])->implode("\n"))
                        ->sendToDiscord();
                }
                else {
                    $user->update([
                        'name' => $socialUser->name,
                        'otp_activated_at' => Carbon::now(),
                        'is_active' => true,
                    ]);

                    $user->meta($provider, $socialUser->id);
                }
            }


            auth('accounts')->login($user);

            Notification::make()
                ->title('Welcome '. $user->name)
                ->body('You have successfully registered')
                ->success()
                ->send();

            return redirect()->to('/user');
        }
        catch (\Exception $exception){

            if(config('filament-discord.error-webhook-active')){
                try {
                    dispatch(new NotifyDiscordJob([
                        'webhook' => config('filament-discord.error-webhook'),
                        'title' => $exception->getMessage(),
                        'message' => collect([
                            "File: ".$exception->getFile(),
                            "Line: ".$exception->getLine(),
                            "Time: ".\Carbon\Carbon::now()->toDateTimeString(),
                            "Trace: ```".str($exception->getTraceAsString())->limit(2500) ."```",
                        ])->implode("\n"),
                        'url' => url()->current()
                    ]));
                }catch (\Exception $exception){
                    // do nothing
                }
            }

            Notification::make()
                ->title('Error')
                ->body('Something went wrong!')
                ->danger()
                ->send();
            return redirect()->to('/');
        }
    }
}
