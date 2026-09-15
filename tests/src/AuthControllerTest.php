<?php

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use TomatoPHP\FilamentSocial\Models\SocialAuthUser;
use TomatoPHP\FilamentSocial\Tests\Models\User;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\withSession;

function fakeSocialiteUser(array $attributes = []): SocialiteUser
{
    $attributes = [
        'id' => '12345',
        'nickname' => 'octo',
        'name' => 'Octo Cat',
        'email' => 'octo@example.com',
        'avatar' => 'https://example.com/octo.png',
        ...$attributes,
    ];

    return (new SocialiteUser)->setRaw($attributes)->map($attributes);
}

function fakeSocialiteCallback(SocialiteUser $socialiteUser): void
{
    Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
}

it('redirects to the provider and remembers the panel', function () {
    get(route('login.provider', ['provider' => 'github']).'?url='.urlencode('http://localhost/admin/login'))
        ->assertRedirectContains('github.com/login/oauth/authorize');

    expect(session('current_panel'))->toBe('admin');
});

it('rejects a provider redirect without a return url', function () {
    get(route('login.provider', ['provider' => 'github']))
        ->assertSessionHasErrors('url');
});

it('registers a new user on the first callback and logs them in', function () {
    fakeSocialiteCallback(fakeSocialiteUser());

    withSession(['current_panel' => 'admin'])
        ->get(route('login.provider.callback', ['provider' => 'github']))
        ->assertRedirect('admin');

    $user = User::query()->where('email', 'octo@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->name)->toBe('Octo Cat')
        ->and($user->username)->toBe('octo')
        ->and($user->profile_photo_path)->toBe('https://example.com/octo.png')
        ->and(SocialAuthUser::query()
            ->where('model_id', $user->id)
            ->where('provider', 'github')
            ->where('provider_id', '12345')
            ->exists())->toBeTrue();

    assertAuthenticatedAs($user);
});

it('registers a new user when the discord notification is enabled but the discord driver is not installed', function () {
    config()->set('filament-social.notification.discord', true);

    fakeSocialiteCallback(fakeSocialiteUser());

    withSession(['current_panel' => 'admin'])
        ->get(route('login.provider.callback', ['provider' => 'github']))
        ->assertRedirect('admin');

    assertAuthenticatedAs(User::query()->where('email', 'octo@example.com')->firstOrFail());
});

it('logs a returning user in again and refreshes the stored profile', function () {
    $user = User::factory()->create(['email' => 'octo@example.com', 'name' => 'Old Name']);
    $user->socialAuthUser()->create([
        'provider' => 'github',
        'provider_id' => '12345',
        'data' => [],
    ]);

    fakeSocialiteCallback(fakeSocialiteUser());

    withSession(['current_panel' => 'admin'])
        ->get(route('login.provider.callback', ['provider' => 'github']))
        ->assertRedirect('admin');

    assertAuthenticatedAs($user);

    expect($user->fresh()->name)->toBe('Octo Cat')
        ->and($user->socialAuthUser()->first()->data['email'] ?? null)->toBe('octo@example.com');
});

it('links a provider to an existing account with the same email', function () {
    $user = User::factory()->create(['email' => 'octo@example.com']);

    fakeSocialiteCallback(fakeSocialiteUser());

    withSession(['current_panel' => 'admin'])
        ->get(route('login.provider.callback', ['provider' => 'github']))
        ->assertRedirect('admin');

    assertAuthenticatedAs($user);

    expect(User::query()->count())->toBe(1);
});

it('sends the visitor to register when the provider rejects the callback', function () {
    Socialite::shouldReceive('driver->user')->andThrow(new RuntimeException('invalid state'));

    withSession(['current_panel' => 'admin'])
        ->get(route('login.provider.callback', ['provider' => 'github']))
        ->assertRedirect('admin/register');

    assertGuest();
});
