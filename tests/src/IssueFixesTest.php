<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentSocial\Filament\Actions\SocialShareAction;
use TomatoPHP\FilamentSocial\FilamentSocialServiceProvider;

use function Pest\Laravel\get;

afterEach(function () {
    File::deleteDirectory(lang_path('vendor/filament-social'));
});

it('shows a translated separator on the login page instead of a cms:: key (#1)', function () {
    get('/admin/login')
        ->assertSuccessful()
        ->assertDontSee('cms::messages.login.or')
        ->assertSee(trans('filament-social::messages.login.or'))
        ->assertSee(trans('filament-social::messages.login.with', ['provider' => 'Github']), false);
});

it('uses published translation overrides on the login page (#2)', function () {
    File::ensureDirectoryExists(lang_path('vendor/filament-social/en'));
    File::put(lang_path('vendor/filament-social/en/messages.php'), "<?php return ['login' => ['or' => 'Or continue with']];");

    app('translator')->setLoaded([]);

    get('/admin/login')
        ->assertSuccessful()
        ->assertSee('Or continue with');

    expect(ServiceProvider::pathsToPublish(FilamentSocialServiceProvider::class, 'filament-social-lang'))
        ->toContain(lang_path('vendor/filament-social'));
});

it('shares a specific url and title instead of the current page (#3)', function () {
    $html = Blade::render('<x-filament-social-share inline facebook url="https://example.com/posts/1" title="First post" />');

    expect($html)
        ->toContain('data-url="https://example.com/posts/1"')
        ->toContain('data-title="First post"');

    $action = SocialShareAction::make()
        ->facebook()
        ->shareUrl(fn (): string => 'https://example.com/posts/2')
        ->shareTitle('Second post');

    expect($action->getShareUrl())->toBe('https://example.com/posts/2')
        ->and($action->getShareTitle())->toBe('Second post');
});
