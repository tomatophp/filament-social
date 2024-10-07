<?php

namespace TomatoPHP\FilamentSocial\Filament\Actions\Form;


use Filament\Forms\Components\Actions\Action;

class SocialShareAction extends Action
{
    protected string $view = 'filament-social::actions.social-share';

    protected bool|\Closure $inline = false;
    protected bool|\Closure $facebook = false;
    protected bool|\Closure $twitter = false;
    protected bool|\Closure $whatsapp = false;
    protected bool|\Closure $linkedin = false;
    protected bool|\Closure $reddit = false;
    protected bool|\Closure $pinterest = false;
    protected bool|\Closure $telegram = false;
    protected bool|\Closure $mail = false;
    protected bool|\Closure $copy = false;
    protected bool|\Closure $print = false;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->name('social-share');
        $this->view('filament-social::actions.social-share');
    }

    public function inline(bool|\Closure $inline = true): static
    {
        $this->inline = $inline;
        return $this;
    }

    public function facebook(bool|\Closure $facebook = true): static
    {
        $this->facebook = $facebook;
        return $this;
    }

    public function twitter(bool|\Closure $twitter = true): static
    {
        $this->twitter = $twitter;
        return $this;
    }

    public function whatsapp(bool|\Closure $whatsapp = true): static
    {
        $this->whatsapp = $whatsapp;
        return $this;
    }

    public function linkedin(bool|\Closure $linkedin = true): static
    {
        $this->linkedin = $linkedin;
        return $this;
    }

    public function reddit(bool|\Closure $reddit = true): static
    {
        $this->reddit = $reddit;
        return $this;
    }

    public function pinterest(bool|\Closure $pinterest = true): static
    {
        $this->pinterest = $pinterest;
        return $this;
    }

    public function telegram(bool|\Closure $telegram = true): static
    {
        $this->telegram = $telegram;
        return $this;
    }

    public function mail(bool|\Closure $mail = true): static
    {
        $this->mail = $mail;
        return $this;
    }

    public function copy(bool|\Closure $copy = true): static
    {
        $this->copy = $copy;
        return $this;
    }

    public function print(bool|\Closure $print = true): static
    {
        $this->print = $print;
        return $this;
    }

    public function isFacebook(): bool
    {
        return $this->evaluate($this->facebook);
    }

    public function isTwitter(): bool
    {
        return $this->evaluate($this->twitter);
    }

    public function isWhatsapp(): bool
    {
        return $this->evaluate($this->whatsapp);
    }

    public function isLinkedin(): bool
    {
        return $this->evaluate($this->linkedin);
    }

    public function isReddit(): bool
    {
        return $this->evaluate($this->reddit);
    }

    public function isPinterest(): bool
    {
        return $this->evaluate($this->pinterest);
    }

    public function isTelegram(): bool
    {
        return $this->evaluate($this->telegram);
    }

    public function isMail(): bool
    {
        return $this->evaluate($this->mail);
    }

    public function isCopy(): bool
    {
        return $this->evaluate($this->copy);
    }

    public function isPrint(): bool
    {
        return $this->evaluate($this->print);
    }

    public function isInline(): bool
    {
        return $this->evaluate($this->inline);
    }
}