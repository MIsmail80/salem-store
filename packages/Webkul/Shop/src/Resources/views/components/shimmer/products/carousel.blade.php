<!-- Premium Products Section Shimmer -->
<section class="relative py-16 max-md:py-10 max-sm:py-8">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-50 via-white to-gray-50"></div>

    <div class="container relative max-lg:px-8 max-sm:!px-4">
        <div class="flex items-center justify-between mb-10 max-md:mb-6">
            <div class="relative">
                <div class="w-12 h-0.5 shimmer mb-3"></div>
                <h3 class="shimmer h-8 w-[200px] max-sm:h-7"></h3>
                <div class="mt-2 w-24 h-px shimmer"></div>
            </div>

            <div class="flex items-center gap-3 max-lg:hidden">
                <span class="shimmer inline-block h-11 w-11 rounded-full" role="presentation"></span>
                <span class="shimmer inline-block h-11 w-11 rounded-full" role="presentation"></span>
            </div>

            <div class="shimmer h-7 w-24 max-sm:h-5 max-sm:w-[68px] lg:hidden"></div>
        </div>

        <div class="scrollbar-hide flex gap-6 overflow-auto pb-4 max-md:gap-5 max-sm:gap-4">
            <x-shop::shimmer.products.cards.grid class="min-w-[291px] max-md:h-fit max-md:min-w-56 max-sm:min-w-[192px]"
                :count="4" />
        </div>

        @if ($navigationLink)
            <div class="flex justify-center mt-10 max-lg:hidden">
                <a class="shimmer h-12 w-[180px] rounded-full" role="button" aria-label="Show more products"></a>
            </div>
        @endif
    </div>
</section>