<?php

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\TwitterProvider;
use Revolution\Socialite\Discord\DiscordProvider;
use SocialiteProviders\Facebook\Provider;

it('resolves the :dataset socialite driver', function (string $driver, string $configKey, string $expectedClass) {
    config()->set("services.{$configKey}", [
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'redirect' => "http://localhost/login/{$driver}/callback",
    ]);

    expect(Socialite::driver($driver))->toBeInstanceOf($expectedClass);
})->with([
    'github' => ['github', 'github', GithubProvider::class],
    'google' => ['google', 'google', GoogleProvider::class],
    'twitter-oauth-2' => ['twitter-oauth-2', 'twitter', TwitterProvider::class],
    'discord' => ['discord', 'discord', DiscordProvider::class],
    'facebook' => ['facebook', 'facebook', Provider::class],
    'tiktok' => ['tiktok', 'tiktok', SocialiteProviders\TikTok\Provider::class],
    'snapchat' => ['snapchat', 'snapchat', SocialiteProviders\Snapchat\Provider::class],
]);
