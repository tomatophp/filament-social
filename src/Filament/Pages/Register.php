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
}
