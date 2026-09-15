@php
    $providers = collect(config('filament-social.providers', []))
        ->filter(fn (string $provider): bool => filled(config('services.' . str($provider)->before('-') . '.client_id')));
@endphp

{{-- Inline styles: package views are not scanned by the panel's Tailwind build. --}}
@if ($providers->isNotEmpty())
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        <div class="fi-color-gray" style="text-align: center; font-size: 0.875rem; opacity: 0.8;">
            {{ trans('filament-social::messages.login.or') }}
        </div>
        <div style="display: flex; justify-content: center; gap: 1rem;">
            @foreach ($providers as $provider)
                @php($name = (string) str($provider)->before('-'))
                <a
                    x-tooltip="{ content: @js(trans('filament-social::messages.login.with', ['provider' => ucfirst($name)])), theme: $store.theme }"
                    href="{{ route('login.provider', ['provider' => $provider]) . '?url=' . url()->current() }}"
                    style="display: inline-flex;"
                >
                    <x-icon name="bxl-{{ $name }}" style="width: 2rem; height: 2rem;" />
                </a>
            @endforeach
        </div>
    </div>
@endif
