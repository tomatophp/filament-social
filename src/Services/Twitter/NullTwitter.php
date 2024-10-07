<?php

declare(strict_types=1);

namespace TomatoPHP\FilamentSocial\Services\Twitter;

final readonly class NullTwitter implements TwitterInterface
{
    public function tweet(string $status): ?array
    {
        return null;
    }
}
