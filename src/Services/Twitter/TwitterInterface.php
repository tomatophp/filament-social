<?php

declare(strict_types=1);

namespace TomatoPHP\FilamentSocial\Services\Twitter;

interface TwitterInterface
{
    public function tweet(string $status): ?array;
}
