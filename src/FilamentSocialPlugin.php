<?php

namespace TomatoPHP\FilamentSocial;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentSocial\Filament\Pages\Login;
use TomatoPHP\FilamentSocial\Filament\Pages\Register;

class FilamentSocialPlugin implements Plugin
{

    public static bool $login = false;
    public static bool $register = false;

    public function getId(): string
    {
        return 'filament-social';
    }

    public function socialLogin(bool $login=true): static
    {
        self::$login = $login;
        return $this;
    }

    public function socialRegister(bool $register=true): static
    {
        self::$register = $register;
        return $this;
    }


    public function register(Panel $panel): void
    {
        if(self::$login){
            $panel->login(Login::class);
        }

        if(self::$register){
            $panel->registration(Register::class);
        }
    }

    public function boot(Panel $panel): void
    {
       //
    }

    public static function make(): static
    {
        return new static();
    }
}
