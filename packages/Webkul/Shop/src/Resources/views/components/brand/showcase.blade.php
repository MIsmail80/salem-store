@props(['options'])

<v-brand-showcase
    src="{{ route('shop.api.categories.index', array_merge(['parent_id' => $options['filters']['parent_id'] ?? 1], ['limit' => $options['filters']['limit'] ?? 8], ['sort' => $options['filters']['sort'] ?? 'asc'])) }}"
    brand-name="{{ $options['brand_name'] ?? '' }}"
    brand-subtitle="{{ $options['brand_subtitle'] ?? '' }}"
    brand-color="{{ $options['brand_color'] ?? '#e63946' }}"
>
    <!-- Shimmer placeholder while loading -->
    <div class="w-full overflow-hidden bg-white py-12 max-md:py-8">
        <div class="container mx-auto max-lg:px-8 max-md:px-4">
            <div class="mb-8 flex justify-center">
                <div class="shimmer h-12 w-64 rounded"></div>
            </div>
            <div class="flex gap-5 overflow-hidden">
                @for ($i = 0; $i < 5; $i++)
                    <div class="shimmer rounded-2xl shrink-0 min-w-[150px] h-[240px] max-sm:min-w-[120px] max-sm:h-[190px]"></div>
                @endfor
            </div>
        </div>
    </div>
</v-brand-showcase>

@pushOnce('scripts')
<script type="text/x-template" id="v-brand-showcase-template">
    <section class="w-full bg-white py-12 max-md:py-8" v-if="!isLoading && categories?.length">
        <div class="container mx-auto max-lg:px-8 max-md:px-4">

            <!-- Brand Header -->
            <div class="mb-10 text-center max-md:mb-7">
                <h2 class="inline-flex items-baseline gap-3 text-5xl font-black tracking-tight max-md:text-4xl max-sm:text-3xl">
                    <span
                        class="font-black italic text-gold"
                        v-text="brandName"
                    ></span>
                    <span
                        class="font-black text-black uppercase tracking-widest"
                        v-text="brandSubtitle"
                        v-if="brandSubtitle"
                    ></span>
                </h2>
                <!-- Accent underline -->
                <div
                    class="mx-auto mt-2 h-1 w-24 rounded-full bg-gold"
                ></div>
            </div>

            <!-- Cards Row -->
            <div class="relative">
                <div
                    ref="scrollContainer"
                    class="scrollbar-hide flex gap-5 overflow-x-auto scroll-smooth pb-2 max-sm:gap-3"
                >
                    <a
                        v-for="category in categories"
                        :key="category.id"
                        :href="category.slug"
                        class="group relative flex flex-col overflow-hidden rounded-2xl shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl shrink-0 min-w-[150px] max-w-[150px] h-[240px] max-sm:min-w-[120px] max-sm:max-w-[120px] max-sm:h-[190px]"
                    >
                        <!-- Card image -->
                        <div class="relative h-full w-full overflow-hidden bg-white">
                            <img
                                :src="category.logo?.original_image_url || '{{ bagisto_asset('images/small-product-placeholder.webp') }}'"
                                :alt="category.name"
                                class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            />
                        </div>
                    </a>
                </div>

                <!-- Left Arrow -->
                <button
                    class="absolute -left-5 top-1/2 -translate-y-1/2 hidden h-11 w-11 items-center justify-center rounded-full border-2 border-gray-200 bg-white text-gray-700 shadow-md transition-all duration-200 hover:border-gray-400 hover:shadow-lg md:flex max-lg:-left-3"
                    @click="navigate('left')"
                    aria-label="@lang('shop::components.carousel.previous')"
                >
                    <span class="icon-arrow-left-stylish text-xl"></span>
                </button>

                <!-- Right Arrow -->
                <button
                    class="absolute -right-5 top-1/2 -translate-y-1/2 hidden h-11 w-11 items-center justify-center rounded-full border-2 border-gray-200 bg-white text-gray-700 shadow-md transition-all duration-200 hover:border-gray-400 hover:shadow-lg md:flex max-lg:-right-3"
                    @click="navigate('right')"
                    aria-label="@lang('shop::components.carousel.next')"
                >
                    <span class="icon-arrow-right-stylish text-xl"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Loading shimmer -->
    <template v-if="isLoading">
        <div class="w-full overflow-hidden bg-white py-12 max-md:py-8">
            <div class="container mx-auto max-lg:px-8 max-md:px-4">
                <div class="mb-8 flex justify-center">
                    <div class="shimmer h-12 w-64 rounded"></div>
                </div>
                <div class="flex gap-5 overflow-hidden">
                    <div v-for="n in 5" :key="n" class="shimmer rounded-2xl shrink-0 min-w-[150px] h-[240px] max-sm:min-w-[120px] max-sm:h-[190px]"></div>
                </div>
            </div>
        </div>
    </template>
</script>

<script type="module">
    app.component('v-brand-showcase', {
        template: '#v-brand-showcase-template',

        props: {
            src:           { type: String, required: true },
            brandName:     { type: String, default: '' },
            brandSubtitle: { type: String, default: '' },
            brandColor:    { type: String, default: '#e63946' },
        },

        data() {
            return {
                isLoading:  true,
                categories: [],
                offset:     240,
            };
        },

        mounted() {
            this.getCategories();
        },

        methods: {
            getCategories() {
                this.$axios.get(this.src)
                    .then(response => {
                        this.categories = response.data.data;
                        this.isLoading  = false;
                    })
                    .catch(error => console.error(error));
            },

            navigate(dir) {
                const container = this.$refs.scrollContainer;

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
