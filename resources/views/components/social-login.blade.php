@php
    $providers = collect(config('filament-social.providers', []))
        ->filter(fn (string $provider): bool => filled(config('services.' . str($provider)->before('-') . '.client_id')));
@endphp

@if ($providers->isNotEmpty())
    <div class="flex flex-col gap-4">
        <div class="text-center text-sm text-gray-500 dark:text-gray-400">
            {{ trans('filament-social::messages.login.or') }}
        </div>
        <div class="flex justify-center gap-4">
            @foreach ($providers as $provider)
                @php($name = (string) str($provider)->before('-'))
                <a
                    x-tooltip="{ content: @js(trans('filament-social::messages.login.with', ['provider' => ucfirst($name)])), theme: $store.theme }"
                    href="{{ route('login.provider', ['provider' => $provider]) . '?url=' . url()->current() }}"
                >
                    <x-icon name="bxl-{{ $name }}" class="h-8 w-8" />
                </a>
            @endforeach
        </div>
    </div>
@endif
