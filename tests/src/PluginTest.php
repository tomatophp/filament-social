<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use TomatoPHP\FilamentSocial\Filament\Pages\Login;
use TomatoPHP\FilamentSocial\Filament\Pages\Register;
use TomatoPHP\FilamentSocial\FilamentSocialPlugin;
use TomatoPHP\FilamentSocial\FilamentSocialServiceProvider;

use function Pest\Laravel\artisan;

it('boots the service provider', function () {
    expect(app()->getProviders(FilamentSocialServiceProvider::class))->not->toBeEmpty()
        ->and(config('filament-social.providers'))->toBeArray();
});

it('registers the plugin with the social login and register pages', function () {
    $panel = Filament::getPanel('admin');

    expect($panel->getPlugin('filament-social'))->toBeInstanceOf(FilamentSocialPlugin::class)
        ->and($panel->getLoginRouteAction())->toBe(Login::class)
        ->and($panel->getRegistrationRouteAction())->toBe(Register::class);
});

it('registers the install command', function () {
    expect(Artisan::all())->toHaveKey('filament-social:install');
});

it('runs the install command and creates the social accounts table', function () {
    artisan('filament-social:install')->assertSuccessful();

    expect(Schema::hasTable('social_auth_users'))->toBeTrue()
        ->and(Schema::hasColumns('users', ['username', 'profile_photo_path']))->toBeTrue();
});
