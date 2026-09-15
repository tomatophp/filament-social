@php
    $inline= $isInline();
    $shareUrl = $getShareUrl();
    $shareTitle = $getShareTitle();
    $facebook = $isFacebook();
    $twitter = $isTwitter();
    $reddit = $isReddit();
    $pinterest = $isPinterest();
    $linkedin = $isLinkedin();
    $telegram = $isTelegram();
    $whatsapp = $isWhatsapp();
    $copy = $isCopy();
    $print = $isPrint();
    $mail = $isMail();
@endphp

@if($inline)
    <div class="my-4">
        <div class="share-btn" style="margin: 1rem 1rem 0; display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;" @if(filled($shareUrl)) data-url="{{ $shareUrl }}" @endif @if(filled($shareTitle)) data-title="{{ $shareTitle }}" @endif>
            @if($facebook)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.facebook') }}', theme: $store.theme}" style="background-color: #1e40af; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="fb">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <x-icon name="bxl-facebook-square" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                </a>
            @endif
            @if($twitter)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.twitter') }}', theme: $store.theme}"  style="background-color: #1DA1F2; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="tw">
                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <x-icon name="bxl-twitter" style="width: 1.25rem; height: 1.25rem;" />
                        </div>
                    </a>
            @endif
            @if($reddit)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.reddit') }}', theme: $store.theme}"  style="background-color: #FF8b60; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="re">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <x-icon name="bxl-reddit" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                </a>
            @endif
            @if($pinterest)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.pinterest') }}', theme: $store.theme}"  style="background-color: #E60023; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="pi">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <x-icon name="bxl-pinterest" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                </a>
            @endif
            @if($linkedin)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.linkedin') }}', theme: $store.theme}"  style="background-color: #0077B5; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="in">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <x-icon name="bxl-linkedin" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                </a>
            @endif
            @if($telegram)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.telegram') }}', theme: $store.theme}" style="background-color: #24A1DE; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="tg">
                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <x-icon name="bxl-telegram" style="width: 1.25rem; height: 1.25rem;" />
                        </div>
                    </a>
            @endif
            @if($whatsapp)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.whatsapp') }}', theme: $store.theme}" style="background-color: #075E54; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="wa">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <x-icon name="bxl-whatsapp" style="width: 1.25rem; height: 1.25rem;" />
                </div>
            </a>
            @endif
            @if($copy)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.copy') }}', theme: $store.theme}"   style="--c-400:var(--danger-400);--c-500:var(--danger-500);--c-600:var(--danger-600); background-color: var(--c-600); color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="wa">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <x-icon name="bxs-copy" style="width: 1.25rem; height: 1.25rem;" />
                </div>
            </a>
            @endif
            @if($print)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.print') }}', theme: $store.theme}" style="--c-400:var(--info-400);--c-500:var(--info-500);--c-600:var(--info-600); background-color: var(--c-600); color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="wa">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <x-icon name="bxs-printer" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                </a>
            @endif
            @if($mail)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.mail') }}', theme: $store.theme}"  style="--c-400:var(--warning-400);--c-500:var(--warning-500);--c-600:var(--warning-600); background-color: var(--c-600); color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="wa">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <x-icon name="bxs-envelope" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                </a>
            @endif
            <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.share') }}', theme: $store.theme}" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600); background-color: var(--c-600); color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; display: flex; justify-content: center; gap: 0.5rem;" data-id="share">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <x-icon name="heroicon-s-share" style="width: 1.25rem; height: 1.25rem;" />
                </div>
            </a>
        </div>
    </div>
@else
    <x-filament::dropdown>
        <x-slot name="trigger">
            <x-filament::button icon="heroicon-s-share">
                {{ trans('filament-social::messages.share.title') }}
            </x-filament::button>
        </x-slot>

        <x-filament::dropdown.list class="share-btn" :data-url="$shareUrl" :data-title="$shareTitle">
            @if($facebook)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="fb" icon="bxl-facebook-square">
                    {{ trans('filament-social::messages.share.networks.facebook') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($twitter)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="tw" icon="bxl-twitter">
                    {{ trans('filament-social::messages.share.networks.twitter') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($reddit)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="re" icon="bxl-reddit">
                    {{ trans('filament-social::messages.share.networks.reddit') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($pinterest)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="pi" icon="bxl-pinterest">
                    {{ trans('filament-social::messages.share.networks.pinterest') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($linkedin)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="in" icon="bxl-linkedin">
                    {{ trans('filament-social::messages.share.networks.linkedin') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($telegram)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="tg" icon="bxl-telegram">
                    {{ trans('filament-social::messages.share.networks.telegram') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($whatsapp)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="wa" icon="bxl-whatsapp"  >
                    {{ trans('filament-social::messages.share.networks.whatsapp') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($copy)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="copy" icon="bxs-copy" >
                    {{ trans('filament-social::messages.share.networks.copy') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($print)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="print" icon="bxs-printer" >
                    {{ trans('filament-social::messages.share.networks.print') }}
                </x-filament::dropdown.list.item>
            @endif
            @if($mail)
                <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="mail" icon="bxs-envelope" >
                    {{ trans('filament-social::messages.share.networks.mail') }}
                </x-filament::dropdown.list.item>
            @endif
            <x-filament::dropdown.list.item class="cursor-pointer" tag="a" data-id="share" icon="bxs-share-alt" >
                {{ trans('filament-social::messages.share.networks.share') }}
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
@endif


<script src="https://cdn.jsdelivr.net/npm/share-buttons/dist/share-buttons.js"></script>
