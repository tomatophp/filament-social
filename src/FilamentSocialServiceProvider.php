<?php

namespace TomatoPHP\FilamentSocial;

use Illuminate\Support\ServiceProvider;


class FilamentSocialServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentSocial\Console\FilamentSocialInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-social.php', 'filament-social');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-social.php' => config_path('filament-social.php'),
        ], 'filament-social-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'filament-social-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-social');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-social'),
        ], 'filament-social-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-social');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-social'),
        ], 'filament-social-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
