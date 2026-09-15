<?php

namespace TomatoPHP\FilamentSocial\Filament\Pages;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;

class Register extends BaseRegister
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
