<?php

declare(strict_types=1);

namespace TomatoPHP\FilamentSocial\Services\Twitter;

use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert;
use stdClass;

final class TwitterFake implements TwitterInterface
{
    protected array $tweets = [];

    public function tweet(string $status): ?array
    {
        $this->tweets[] = $status;

        $data = new stdClass();
        $data->id = fake()->numberBetween(1_000_000_000_000_000_000, 2_000_000_000_000_000_000);
        $data->text = $status;

        return compact('data');
    }

    public function assertTweetSent(string $status): self
    {
        Assert::assertContains($status, $this->tweets);

        return $this;
    }

    public function assertTweetNotSent(string $status): self
    {
        Assert::assertNotContains($status, $this->tweets);

        return $this;
    }

    public function assertNoTweetsSent(): self
    {
        Assert::assertEmpty($this->tweets);

        return $this;
    }

    public function assertTweetCount(int $count): self
    {
        Assert::assertCount($count, $this->tweets);

        return $this;
    }

    public function assertLastTweet(string $status): self
    {
        Assert::assertSame($status, Arr::last($this->tweets));

        return $this;
    }
}
