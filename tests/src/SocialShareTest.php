<?php

use Filament\Actions\Action;
use Illuminate\Support\Facades\Blade;
use TomatoPHP\FilamentSocial\Filament\Actions\Form\SocialShareAction as FormSocialShareAction;
use TomatoPHP\FilamentSocial\Filament\Actions\Notifications\SocialShareAction as NotificationSocialShareAction;
use TomatoPHP\FilamentSocial\Filament\Actions\SocialShareAction;
use TomatoPHP\FilamentSocial\Filament\Actions\Table\SocialShareAction as TableSocialShareAction;
use TomatoPHP\FilamentSocial\Tests\Models\User;
use TomatoPHP\FilamentSocial\Tests\Pages\SharePage;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('renders the share component with only the selected networks', function () {
    $html = Blade::render('<x-filament-social-share inline facebook twitter />');

    expect($html)
        ->toContain('data-id="fb"')
        ->toContain('data-id="tw"')
        ->not->toContain('data-id="in"');
});

it('renders the share action on a page', function () {
    actingAs(User::factory()->create());

    livewire(SharePage::class)
        ->assertSuccessful()
        ->assertSeeHtml('data-id="fb"')
        ->assertSeeHtml('data-id="tw"')
        ->assertSeeHtml('data-id="copy"')
        ->assertDontSeeHtml('data-id="in"');
});

it('keeps the form, table and notification share actions as Filament actions', function (string $class) {
    expect($class::make())->toBeInstanceOf(Action::class)
        ->and($class::make()->getName())->toBe('social-share');
})->with([
    SocialShareAction::class,
    FormSocialShareAction::class,
    TableSocialShareAction::class,
    NotificationSocialShareAction::class,
]);
