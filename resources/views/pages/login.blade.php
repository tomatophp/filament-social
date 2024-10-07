<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}

            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
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
        <a x-tooltip="{'content': 'Login With Github', theme: $store.theme}" href="{{ route('login.provider', ['provider' => 'github']) }}">
            <x-icon name="bxl-github" class="w-8 h-8" />
        </a>
        <a x-tooltip="{'content': 'Login With Discord', theme: $store.theme}" href="{{ route('login.provider', ['provider' => 'discord']) }}">
            <x-icon name="bxl-discord" class="w-8 h-8" />
        </a>
    </div>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</x-filament-panels::page.simple>
