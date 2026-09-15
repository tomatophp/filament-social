<?php

namespace TomatoPHP\FilamentSocial\Tests\Pages;

use Filament\Pages\Page;
use TomatoPHP\FilamentSocial\Filament\Actions\SocialShareAction;

class SharePage extends Page
{
    protected string $view = 'share-page';

    protected static ?string $slug = 'share-page';

    protected function getHeaderActions(): array
    {
        return [
            SocialShareAction::make()
                ->facebook()
                ->twitter()
                ->copy(),
        ];
    }
}
