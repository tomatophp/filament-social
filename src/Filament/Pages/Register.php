<?php

namespace TomatoPHP\FilamentSocial\Filament\Pages;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Events\Auth\Registered;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class Register extends \Filament\Pages\Auth\Register
{
    protected static string $view = 'filament-social::pages.register';

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $user->otp_code = $otp;
        $user->is_active = false;
        $user->save();

        session()->put('demo_user', $user->id);

        Notification::make()
            ->title('New TomatoPHP User')
            ->body(collect([
                'NAME: '.$user->name,
                'EMAIL: '.$user->email,
                'PHONE: '.$user->phone,
                'USERNAME: '.$user->username,
                'OTP: '.$otp,
            ])->implode("\n"))
            ->sendToDiscord();

        try {
            $embeds = [];
            $embeds['description'] = "your OTP is: ". $otp;
            $embeds['url'] = url('/otp');

            $params = [
                'content' => "@" . $user->username,
                'embeds' => [
                    $embeds
                ]
            ];

            Http::post(config('services.discord.otp-webhook'), $params)->json();

        }catch (\Exception $e){
            Notification::make()
                ->title(trans('cms::messages.register.form.notifications.error.title'))
                ->body(trans('cms::messages.register.form.notifications.error.body'))
                ->danger()
                ->send();
        }

        return app(RegistrationResponse::class);
    }

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        TextInput::make('phone'),
                        TextInput::make('username')
                            ->label('Discord Username'),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
}
