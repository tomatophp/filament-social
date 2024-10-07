<?php

namespace TomatoPHP\FilamentSocial\Facades;

use Illuminate\Support\Facades\Facade;

class FilamentSocial extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filament-social';
    }
}
