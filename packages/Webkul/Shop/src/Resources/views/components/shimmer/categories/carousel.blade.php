@props(['count' => 0])

<!-- Premium Categories Section Shimmer -->
<section class="relative py-16 max-md:py-10 max-sm:py-8 bg-brandBlack">
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-0.5 bg-gradient-to-r from-transparent via-gold/30 to-transparent">
    </div>

    <div class="container max-lg:px-8 max-md:!px-0">
        <!-- Section Header Shimmer -->
        <div class="text-center mb-10 max-md:mb-8 max-md:px-4">
            <div class="inline-block">
                <div class="shimmer-gold h-4 w-32 mx-auto rounded"></div>
                <div class="shimmer-gold h-8 w-48 mx-auto mt-2 rounded max-md:h-6"></div>
                <div class="mt-3 mx-auto w-16 h-0.5 bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>
            </div>
        </div>

        <div class="relative">
            <div class="scrollbar-hide flex gap-8 overflow-auto px-4 max-lg:gap-6 max-sm:gap-4">
                @for ($i = 0; $i < $count; $i++)
                    <div
                        class="grid min-w-[130px] max-w-[130px] grid-cols-1 justify-items-center gap-4 max-md:min-w-[100px] max-md:max-w-[100px] max-md:gap-3 max-md:first:ml-4 max-sm:min-w-[80px] max-sm:max-w-[80px] max-sm:gap-2">
                        <div
                            class="shimmer-gold relative h-[120px] w-[120px] overflow-hidden rounded-full border-2 border-gold/20 max-md:h-[90px] max-md:w-[90px] max-sm:h-[70px] max-sm:w-[70px]">
                        </div>
                        <p class="shimmer-gold h-5 w-[90px] rounded max-sm:h-4 max-sm:w-[70px]"></p>
                    </div>
                @endfor
            </div>

            <span class="shimmer-gold absolute -left-5 top-[50px] flex h-12 w-12 rounded-full max-md:hidden"
                role="presentation"></span>

            <span class="shimmer-gold absolute -right-5 top-[50px] flex h-12 w-12 rounded-full max-md:hidden"
                role="presentation"></span>
        </div>
    </div>

    <div
        class="absolute bottom-0 left-1/2 -translate-x-1/2 w-32 h-0.5 bg-gradient-to-r from-transparent via-gold/30 to-transparent">
    </div>
</section>