<?php

declare(strict_types=1);

namespace TomatoPHP\FilamentSocial\Facades;

use TomatoPHP\FilamentSocial\Services\Twitter\OAuthTwitter;
use TomatoPHP\FilamentSocial\Services\Twitter\TwitterFake;
use TomatoPHP\FilamentSocial\Services\Twitter\TwitterInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @see OAuthTwitter
 * @see TwitterFake
 */
final class Twitter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TwitterInterface::class;
    }

    public static function fake(): void
    {
        self::swap(new TwitterFake());
    }
}
