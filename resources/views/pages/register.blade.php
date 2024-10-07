<x-filament-panels::page.simple>
    @if (filament()->hasLogin())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/register.actions.login.before') }}

            {{ $this->loginAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="register">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

        <div class="text-center">
            {{ trans('cms::messages.login.or') }}
        </div>
        <div class="flex justify-center gap-4">
            @foreach(config('filament-social.providers') as $provider)
                @if(!empty(config('services.' . (str($provider)->contains('-') ? str($provider)->explode('-')[0] : $provider) . '.client_id')))
                    <a x-tooltip="{'content': 'Login With {{ ucfirst(str($provider)->contains('-') ? str($provider)->explode('-')[0] : $provider) }}', theme: $store.theme}" href="{{ route('login.provider', ['provider' => $provider]) . '?url=' . url()->current() }}">
                        <x-icon name="bxl-{{ str($provider)->contains('-') ? str($provider)->explode('-')[0] : $provider }}" class="w-8 h-8" />
                    </a>
                @endif
            @endforeach
        </div>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</x-filament-panels::page.simple>
