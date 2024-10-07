<?php

namespace TomatoPHP\FilamentSocial\Filament\Pages;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;

class Login extends \Filament\Pages\Auth\Login
{
    protected static string $view = 'filament-social::pages.login';
}
