<?php

namespace TomatoPHP\FilamentSocial;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentSocial\Views\Components\SocialShare;


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

        $this->loadViewComponentsAs('filament', [
            SocialShare::class
        ]);

    }

    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('facebook', \SocialiteProviders\Facebook\Provider::class);
        });

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('tiktok', \SocialiteProviders\TikTok\Provider::class);
        });

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('snapchat', \SocialiteProviders\Snapchat\Provider::class);
        });
    }
}
