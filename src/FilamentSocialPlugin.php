<?php

namespace TomatoPHP\FilamentIssues;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentSocialPlugin implements Plugin
{

    public function getId(): string
    {
        return 'filament-social';
    }


    public function register(Panel $panel): void
    {
        //
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
