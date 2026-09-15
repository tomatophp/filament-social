# v5.0.0

- Requires `filament/filament` ^5.0 (Livewire 4)
- Supports Laravel 12 and 13, PHP 8.2+
- Socialite providers bumped to their Laravel 13 compatible releases (`revolution/socialite-discord` ^1.5, `socialiteproviders/*` 4.x / 5.x / 6.x)
- Social login and register pages ported to the Filament v5 auth pages; the social buttons are rendered below the form (the old `pages/login` and `pages/register` views are gone, republish views if you customised them)
- Show a translated "Or login with" separator instead of `cms::messages.login.or` (#1)
- Provider tooltips are translated and translations publish to `lang_path('vendor/filament-social')`, so published overrides are loaded (#2)
- Share a specific url and title: `SocialShareAction::make()->shareUrl(fn ($record) => ...)->shareTitle(...)` and `<x-filament-social-share url="..." title="..." />` (#3)
- The social callback no longer writes a `data` column on the users table (returning users can log in again), stores the provider profile on `social_auth_users`, keeps usernames unique and only notifies Discord when the Discord driver is installed
- The login buttons and share buttons use inline styles, so they render correctly without adding the package views to your Tailwind 4 theme sources
- The auth controller extends `Illuminate\Routing\Controller` instead of the application controller
- Social share actions consolidated on `Filament\Actions\Action`; the Form, Table and Notifications classes remain as aliases
- `filament-social:install` only runs the migrations (it no longer runs yarn in your project)
- Removed the unused Twitter facade and services (they needed `abraham/twitteroauth`, which was never required)
- Added a Pest test suite and CI for PHP 8.3 / 8.4 on Laravel 12 / 13
- The Filament v3 line continues on the `v3` branch
