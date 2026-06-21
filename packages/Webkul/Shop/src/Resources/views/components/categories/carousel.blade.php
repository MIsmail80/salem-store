<v-categories-carousel src="{{ $src }}" title="{{ $title }}" navigation-link="{{ $navigationLink ?? '' }}">
    <x-shop::shimmer.categories.carousel :count="8" :navigation-link="$navigationLink ?? false" />
</v-categories-carousel>

@pushOnce('scripts')
    <script type="text/x-template" id="v-categories-carousel-template">
            <!-- Premium Categories Section with Dark Theme -->
    <section class="relative py-16 max-md:py-10 max-sm:py-8 bg-brandBlack" v-if="! isLoading && categories?.length">
        <!-- Decorative gold line at top -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-0.5 bg-gradient-to-r from-transparent via-gold to-transparent">
        </div>

        <div class="container max-lg:px-8 max-md:!px-0">
            <!-- Section Header -->
            <div class="text-center mb-10 max-md:mb-8 max-md:px-4">
                <div class="inline-block relative">
                    <span
                        class="text-gold/60 text-sm uppercase tracking-[0.3em] font-medium">@lang('shop::app.home.index.categories-carousel')</span>
                    <h2 class="font-dmserif text-3xl text-white mt-2 max-md:text-2xl max-sm:text-xl">
                        @{{ title || '@lang('shop::app.home.index.shop-by-category')' }}
                    </h2>
                    <div class="mt-3 mx-auto w-16 h-0.5 bg-gradient-to-r from-transparent via-gold to-transparent"></div>
                </div>
            </div>

            <div class="relative">
                <!-- Categories Carousel -->
                <div ref="swiperContainer"
                    class="scrollbar-hide flex gap-6 overflow-auto scroll-smooth px-4 max-lg:gap-5 max-md:gap-4 max-sm:gap-3">
                    <div class="group grid min-w-[130px] max-w-[130px] grid-cols-1 justify-items-center gap-4 font-medium max-md:min-w-[100px] max-md:max-w-[100px] max-md:gap-3 max-md:first:ml-4 max-sm:min-w-[80px] max-sm:max-w-[80px] max-sm:gap-2 max-sm:first:ml-3"
                        v-for="category in categories">
                        <a :href="category.slug"
                            class="relative h-[120px] w-[120px] rounded-full bg-brandBlack-muted border-2 border-gold/30 overflow-hidden transition-all duration-300 group-hover:border-gold group-hover:shadow-[0_0_20px_rgba(196,163,90,0.3)] max-md:h-[90px] max-md:w-[90px] max-sm:h-[70px] max-sm:w-[70px]"
                            :aria-label="category.name">
                            <!-- Gold glow effect on hover -->
                            <div
                                class="absolute inset-0 bg-gradient-to-tr from-gold/0 to-gold/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <x-shop::media.images.lazy
                                ::src="category.logo?.large_image_url || '{{ bagisto_asset('images/small-product-placeholder.webp') }}'"
                                width="120" height="120"
                                class="w-full h-full object-cover rounded-full transition-transform duration-500 group-hover:scale-110"
                                ::alt="category.name" />
                        </a>

                        <a :href="category.slug" class="text-center transition-colors duration-300">
                            <p class="text-white/80 text-sm font-medium group-hover:text-gold transition-colors duration-300 max-md:text-sm max-sm:text-xs leading-tight"
                                v-text="category.name">
                            </p>
                        </a>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button
                    class="absolute -left-5 top-[50px] flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-2 border-gold/50 bg-brandBlack text-gold text-2xl transition-all duration-300 hover:bg-gold hover:text-brandBlack hover:border-gold hover:shadow-[0_0_15px_rgba(196,163,90,0.4)] max-lg:-left-3 max-md:hidden"
                    role="button" aria-label="@lang('shop::components.carousel.previous')" tabindex="0" @click="navigate('left')">
                    <span class="icon-arrow-left-stylish"></span>
                </button>

                <button
                    class="absolute -right-5 top-[50px] flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-2 border-gold/50 bg-brandBlack text-gold text-2xl transition-all duration-300 hover:bg-gold hover:text-brandBlack hover:border-gold hover:shadow-[0_0_15px_rgba(196,163,90,0.4)] max-lg:-right-3 max-md:hidden"
                    role="button" aria-label="@lang('shop::components.carousel.next')" tabindex="0" @click="navigate('right')">
                    <span class="icon-arrow-right-stylish"></span>
                </button>
            </div>
        </div>

        <!-- Decorative gold line at bottom -->
        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-32 h-0.5 bg-gradient-to-r from-transparent via-gold to-transparent">
        </div>
    </section>

    <!-- Category Carousel Shimmer -->
    <template v-if="isLoading">
        <x-shop::shimmer.categories.carousel :count="8" :navigation-link="$navigationLink ?? false" />
    </template>
    </script>

    <script type="module">
        app.component('v-categories-carousel', {
            template: '#v-categories-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
            ],

            data() {
                return {
                    isLoading: true,

                    categories: [],

                    offset: 323,
                };
            },

            mounted() {
                this.getCategories();
            },

            methods: {
                getCategories() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.categories = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                navigate(dir) {
                    const container = this.$refs.swiperContainer;

                    if (dir === 'left') {
                        container.scrollLeft -= this.offset;
                    } else {
                        container.scrollLeft += this.offset;
                    }
                },
            },
        });
    </script>
@endPushOnce