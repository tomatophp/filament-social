<?php

namespace TomatoPHP\FilamentSocial\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialShare extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $inline = false,
        public bool $facebook = false,
        public bool $twitter = false,
        public bool $reddit = false,
        public bool $pinterest = false,
        public bool $linkedin = false,
        public bool $whatsapp = false,
        public bool $telegram = false,
        public bool $mail = false,
        public bool $copy = false,
        public bool $print = false,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('filament-social::components.views.social-share');
    }
}
