<?php

namespace TomatoPHP\FilamentSocial\Traits;

use TomatoPHP\FilamentSocial\Models\SocialAuthUser;

trait InteractsWithSocials
{
    public function socialAuthUser()
    {
        return $this->morphMany(SocialAuthUser::class, 'model', 'model_type', 'model_id');
    }
}
