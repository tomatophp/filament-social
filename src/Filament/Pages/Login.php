<?php

namespace TomatoPHP\FilamentSocial\Filament\Pages;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;

class Login extends BaseLogin
{
    public function content(Schema $schema): Schema
    {
        return parent::content($schema)
            ->components([
                ...parent::content($schema)->getComponents(),
                View::make('filament-social::components.social-login'),
            ]);
    }
}
