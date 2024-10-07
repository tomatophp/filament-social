<div class="my-4">
    <div class="flex flex-col justify-center items-center text-xl font-bold">
        {{ trans('cms::messages.share.title') }}
    </div>
    <div class="mt-4 flex flex-wrap justify-center gap-4 mx-4 share-btn">
        <a title="{{ trans('cms::messages.share.networks.facebook') }}" style="background-color: #1e40af; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="fb">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-facebook" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.twitter') }}" style="background-color: #1DA1F2; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="tw">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-twitter" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.reddit') }}" style="background-color: #FF8b60; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="re">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-reddit" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.pinterest') }}" style="background-color: #E60023; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="pi">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-pinterest" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.linkedin') }}" style="background-color: #0077B5; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="in">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-linkedin" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.telegram') }}" style="background-color: #24A1DE; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="tg">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-telegram" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.whatsapp') }}" style="background-color: #075E54; color: white" class="cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="wa">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="bxl-whatsapp" class="w-5 h-5" />
            </div>
        </a>
        <a title="{{ trans('cms::messages.share.networks.share') }}" class="bg-main cursor-pointer px-4 py-2 rounded-lg flex justify-center gap-2" data-id="share">
            <div class="flex flex-col justify-center items-center">
                <x-icon name="heroicon-s-share" class="w-5 h-5" />
            </div>
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/share-buttons/dist/share-buttons.js"></script>
