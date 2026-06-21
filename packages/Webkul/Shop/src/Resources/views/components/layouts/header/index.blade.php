{!! view_render_event('bagisto.shop.layout.header.before') !!}

@if(core()->getCurrentChannel()->locales()->count() > 1 || core()->getCurrentChannel()->currencies()->count() > 1)
    <div class="max-lg:hidden">
        <x-shop::layouts.header.desktop.top />
    </div>
@endif

<header
    class="shadow-gray sticky top-0 z-10 bg-brandBlack shadow-[0_5px_20px_rgba(196,163,90,0.25)] max-lg:shadow-none">
    <x-shop::layouts.header.desktop />

    <x-shop::layouts.header.mobile />
</header>

{!! view_render_event('bagisto.shop.layout.header.after') !!}