<v-products-carousel src="{{ $src }}" title="{{ $title }}" navigation-link="{{ $navigationLink ?? '' }}">
    <x-shop::shimmer.products.carousel :navigation-link="$navigationLink ?? false" />
</v-products-carousel>

@pushOnce('scripts')
    <script type="text/x-template" id="v-products-carousel-template">
            <!-- Premium Products Section -->
    <section class="relative py-16 max-md:py-10 max-sm:py-8" v-if="! isLoading && products.length">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-b from-gray-50 via-white to-gray-50"></div>

        <div class="container relative max-lg:px-8 max-sm:!px-4">
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-10 max-md:mb-6">
                <div class="relative">
                    <!-- Gold accent line -->
                    <div
                        class="absolute -top-3 left-0 w-12 h-0.5 bg-gradient-to-r from-gold to-gold-light rtl:right-0 rtl:left-auto">
                    </div>
                    <h2 class="font-dmserif text-3xl text-brandBlack max-md:text-2xl max-sm:text-xl">
                        @{{ title }}
                    </h2>
                    <!-- Subtle subtitle line -->
                    <div class="mt-2 w-24 h-px bg-gradient-to-r from-gold/50 to-transparent rtl:bg-gradient-to-l"></div>
                </div>

                <div class="flex items-center gap-6">
                    <!-- Mobile View All Link -->
                    <a :href="navigationLink"
                        class="hidden max-lg:flex items-center gap-2 text-gold hover:text-gold-light transition-colors"
                        v-if="navigationLink">
                        <span class="text-base font-medium max-sm:text-sm">
                            @lang('shop::app.components.products.carousel.view-all')
                        </span>
                        <span class="icon-arrow-right text-lg rtl:icon-arrow-left"></span>
                    </a>

                    <!-- Navigation Arrows -->
                    <template v-if="products.length > 3">
                        <div class="flex items-center gap-3 max-lg:hidden"
                            v-if="products.length > 4 || (products.length > 3 && isScreenMax2xl)">
                            <button
                                class="group flex h-11 w-11 items-center justify-center rounded-full border-2 border-brandBlack bg-white text-brandBlack transition-all duration-300 hover:bg-brandBlack hover:text-gold hover:border-gold hover:shadow-[0_0_15px_rgba(196,163,90,0.3)]"
                                role="button" aria-label="@lang('shop::app.components.products.carousel.previous')"
                                tabindex="0" @click="swipeLeft">
                                <span
                                    class="icon-arrow-left-stylish rtl:icon-arrow-right-stylish text-xl transition-transform group-hover:scale-110"></span>
                            </button>

                            <button
                                class="group flex h-11 w-11 items-center justify-center rounded-full border-2 border-brandBlack bg-white text-brandBlack transition-all duration-300 hover:bg-brandBlack hover:text-gold hover:border-gold hover:shadow-[0_0_15px_rgba(196,163,90,0.3)]"
                                role="button" aria-label="@lang('shop::app.components.products.carousel.next')" tabindex="0"
                                @click="swipeRight">
                                <span
                                    class="icon-arrow-right-stylish rtl:icon-arrow-left-stylish text-xl transition-transform group-hover:scale-110"></span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Products Grid -->
            <div ref="swiperContainer"
                class="flex gap-6 pb-4 [&>*]:flex-[0] overflow-auto scroll-smooth scrollbar-hide max-md:gap-5 max-sm:gap-4">
                <x-shop::products.card class="min-w-[291px] max-md:h-fit max-md:min-w-[220px] max-sm:min-w-[165px]"
                    v-for="product in products" />
            </div>

            <!-- View All Button - Desktop -->
            <div class="flex justify-center mt-10 max-lg:hidden" v-if="navigationLink">
                <a :href="navigationLink"
                    class="group relative inline-flex items-center gap-2 overflow-hidden rounded-full bg-brandBlack px-10 py-3.5 text-gold font-medium transition-all duration-300 hover:shadow-[0_0_25px_rgba(196,163,90,0.4)]"
                    :aria-label="title">
                    <!-- Gold highlight effect on hover -->
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-gold/0 via-gold/10 to-gold/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                    <span class="relative">@lang('shop::app.components.products.carousel.view-all')</span>
                    <span
                        class="relative icon-arrow-right rtl:icon-arrow-left transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1"></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Product Card Listing -->
    <template v-if="isLoading">
        <x-shop::shimmer.products.carousel :navigation-link="$navigationLink ?? false" />
    </template>
    </script>

    <script type="module">
        app.component('v-products-carousel', {
            template: '#v-products-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
            ],

            data() {
                return {
                    isLoading: true,

                    products: [],

                    offset: 323,

                    isScreenMax2xl: window.innerWidth <= 1440,
                };
            },

            mounted() {
                this.getProducts();
            },

            created() {
                window.addEventListener('resize', this.updateScreenSize);
            },

            beforeDestroy() {
                window.removeEventListener('resize', this.updateScreenSize);
            },

            methods: {
                getProducts() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.products = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                updateScreenSize() {
                    this.isScreenMax2xl = window.innerWidth <= 1440;
                },

                swipeLeft() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft -= this.offset;
                },

                swipeRight() {
                    const container = this.$refs.swiperContainer;

                    // Check if scroll reaches the end
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
                        // Reset scroll to the beginning
                        container.scrollLeft = 0;
                    } else {
                        // Scroll to the right
                        container.scrollLeft += this.offset;
                    }
                },
            },
        });
    </script>
@endPushOnce