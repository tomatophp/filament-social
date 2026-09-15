<?php

namespace TomatoPHP\FilamentSocial\Tests\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TomatoPHP\FilamentSocial\Tests\Database\Factories\UserFactory;
use TomatoPHP\FilamentSocial\Traits\InteractsWithSocials;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use InteractsWithSocials;
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
