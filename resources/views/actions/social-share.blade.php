@php
    $inline= $isInline();
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
        <div class="mt-4 flex flex-wrap justify-center gap-4 mx-4 share-btn">
            @if($facebook)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.facebook') }}', theme: $store.theme}" style="background-color: #1e40af; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="fb">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="bxl-facebook-square" class="w-5 h-5" />
                    </div>
                </a>
            @endif
            @if($twitter)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.twitter') }}', theme: $store.theme}"  style="background-color: #1DA1F2; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="tw">
                        <div class="flex flex-col justify-center items-center">
                            <x-icon name="bxl-twitter" class="w-5 h-5" />
                        </div>
                    </a>
            @endif
            @if($reddit)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.reddit') }}', theme: $store.theme}"  style="background-color: #FF8b60; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="re">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="bxl-reddit" class="w-5 h-5" />
                    </div>
                </a>
            @endif
            @if($pinterest)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.pinterest') }}', theme: $store.theme}"  style="background-color: #E60023; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="pi">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="bxl-pinterest" class="w-5 h-5" />
                    </div>
                </a>
            @endif
            @if($linkedin)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.linkedin') }}', theme: $store.theme}"  style="background-color: #0077B5; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="in">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="bxl-linkedin" class="w-5 h-5" />
                    </div>
                </a>
            @endif
            @if($telegram)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.telegram') }}', theme: $store.theme}" style="background-color: #24A1DE; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="tg">
                        <div class="flex flex-col justify-center items-center">
                            <x-icon name="bxl-telegram" class="w-5 h-5" />
                        </div>
                    </a>
            @endif
            @if($whatsapp)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.whatsapp') }}', theme: $store.theme}" style="background-color: #075E54; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="wa">
                <div class="flex flex-col justify-center items-center">
                    <x-icon name="bxl-whatsapp" class="w-5 h-5" />
                </div>
            </a>
            @endif
            @if($copy)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.copy') }}', theme: $store.theme}"   style="--c-400:var(--danger-400);--c-500:var(--danger-500);--c-600:var(--danger-600);" class="bg-custom-600 text-white cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="wa">
                <div class="flex flex-col justify-center items-center">
                    <x-icon name="bxs-copy" class="w-5 h-5" />
                </div>
            </a>
            @endif
            @if($print)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.print') }}', theme: $store.theme}" style="--c-400:var(--info-400);--c-500:var(--info-500);--c-600:var(--info-600);" class="bg-custom-600 text-white cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="wa">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="bxs-printer" class="w-5 h-5" />
                    </div>
                </a>
            @endif
            @if($mail)
                <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.mail') }}', theme: $store.theme}"  style="--c-400:var(--warning-400);--c-500:var(--warning-500);--c-600:var(--warning-600);"  class="bg-custom-600 text-white cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="wa">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="bxs-envelope" class="w-5 h-5" />
                    </div>
                </a>
            @endif
            <a x-tooltip="{content: '{{ trans('filament-social::messages.share.networks.share') }}', theme: $store.theme}" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="bg-custom-600 text-white cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="share">
                <div class="flex flex-col justify-center items-center">
                    <x-icon name="heroicon-s-share" class="w-5 h-5" />
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

        <x-filament::dropdown.list class="share-btn">
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
