@if (Webkul\Product\Helpers\ProductType::hasVariants($product->type))


    {!! view_render_event('bagisto.shop.products.view.configurable-options.before', ['product' => $product]) !!}

    <v-product-configurable-options :errors="errors"></v-product-configurable-options>

    {!! view_render_event('bagisto.shop.products.view.configurable-options.after', ['product' => $product]) !!}

    @push('scripts')
        <script type="text/x-template" id="v-product-configurable-options-template">
                                                                                                                                                                                                                    <div class="w-[455px] max-w-full max-sm:w-full">
                                                                                                                                                                                                                        <input
                                                                                                                                                                                                                            type="hidden"
                                                                                                                                                                                                                            name="selected_configurable_option"
                                                                                                                                                                                                                            id="selected_configurable_option"
                                                                                                                                                                                                                            :value="selectedOptionVariant"
                                                                                                                                                                                                                            ref="selected_configurable_option"
                                                                                                                                                                                                                        >

                                                                                                                                                                                                                        <div
                                                                                                                                                                                                                            class="mt-5"
                                                                                                                                                                                                                            v-for='(attribute, index) in childAttributes'
                                                                                                                                                                                                                        >
                                                                                                                                                                                                                            <!-- Dropdown Options Container - DISABLED: Now using visual swatches for all attributes -->
                                                                                                                                                                                                                            <template v-if="false">
                                                                                                                                                                                                                                <!-- This section is intentionally disabled to force visual swatch rendering -->
                                                                                                                                                                                                                            </template>

                                                                                                                                                                                                                            <!-- Swatch Options Container -->
                                                                                                                                                                                                                    <template v-else>
                                                                                                                                                                                                                        <!-- Option Label -->
                                                                                                                                                                                                                        <h2 class="mb-4 text-xl max-sm:mb-2 max-sm:text-base">
                                                                                                                                                                                                                            @{{ attribute.label }}
                                                                                                                                                                                                                        </h2>

                                                                                                                                                                                                                        <!-- Swatch Options -->
                                                                                                                                                                                                                        <div class="flex items-center gap-3 flex-wrap">
                                                                                                                                                                                                                            <template v-for="(option, index) in attribute.options">
                                                                                                                                                                                                                                <template v-if="option.id">
                                                                                                                                                                                                                                    <!-- Color Swatch Options -->
                                                                                                                                                                                                                                    <label
                                                                                                                                                                                                                                        class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none transition-all hover:scale-110"
                                                                                                                                                                                                                                        :class="{'ring-2 ring-gray-900' : option.id == attribute.selectedValue}"
                                                                                                                                                                                                                                        :title="option.label"
                                                                                                                                                                                                                                        v-if="attribute.swatch_type == 'color' || (attribute.code && attribute.code.toLowerCase() == 'color') || (attribute.label && (attribute.label.toLowerCase().includes('color') || attribute.label.includes('لون')))"
                                                                                                                                                                                                                                    >
                                                                                                                                                                                                                                        <v-field
                                                                                                                                                                                                                                            type="radio"
                                                                                                                                                                                                                                            :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                            :value="option.id"
                                                                                                                                                                                                                                            v-slot="{ field }"
                                                                                                                                                                                                                                            rules="required"
                                                                                                                                                                                                                                            :label="attribute.label"
                                                                                                                                                                                                                                            :aria-label="attribute.label"
                                                                                                                                                                                                                                        >
                                                                                                                                                                                                                                            <input
                                                                                                                                                                                                                                                type="radio"
                                                                                                                                                                                                                                                :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                                :value="option.id"
                                                                                                                                                                                                                                                v-bind="field"
                                                                                                                                                                                                                                                :id="'attribute_' + attribute.id"
                                                                                                                                                                                                                                                :aria-labelledby="'color-choice-' + index + '-label'"
                                                                                                                                                                                                                                                class="peer sr-only"
                                                                                                                                                                                                                                                @click="configure(attribute, $event.target.value)"
                                                                                                                                                                                                                                            />
                                                                                                                                                                                                                                        </v-field>

                                                                                                                                                                                                                                        <span
                                                                                                                                                                                                                                            class="h-14 w-14 rounded-full border-2 border-gray-200 max-sm:h-[40px] max-sm:w-[40px] shadow-sm bg-cover bg-center"
                                                                                                                                                                                                                                            tabindex="0"
                                                                                                                                                                                                                                            :style="getColorCircleStyle(option)"
                                                                                                                                                                                                                                        ></span>
                                                                                                                                                                                                                                    </label>

                                                                                                                                                                                                                                    <!-- Image Swatch Options -->
                                                                                                                                                                                                                                    <label 
                                                                                                                                                                                                                                        class="group relative flex h-[60px] w-[60px] cursor-pointer items-center justify-center overflow-hidden rounded-md border bg-white font-medium uppercase text-gray-900 hover:bg-gray-50 sm:py-6 transition-all hover:shadow-md"
                                                                                                                                                                                                                                        :class="{'border-navyBlue ring-2 ring-navyBlue' : option.id == attribute.selectedValue }"
                                                                                                                                                                                                                                        :title="option.label"
                                                                                                                                                                                                                                        v-else-if="attribute.swatch_type == 'image'"
                                                                                                                                                                                                                                    >
                                                                                                                                                                                                                                        <v-field
                                                                                                                                                                                                                                            type="radio"
                                                                                                                                                                                                                                            :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                            v-model="attribute.selectedValue"
                                                                                                                                                                                                                                            :value="option.id"
                                                                                                                                                                                                                                            v-slot="{ field }"
                                                                                                                                                                                                                                            rules="required"
                                                                                                                                                                                                                                            :label="attribute.label"
                                                                                                                                                                                                                                            :aria-label="attribute.label"
                                                                                                                                                                                                                                        >
                                                                                                                                                                                                                                            <input
                                                                                                                                                                                                                                                type="radio"
                                                                                                                                                                                                                                                :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                                :value="option.id"
                                                                                                                                                                                                                                                v-bind="field"
                                                                                                                                                                                                                                                :id="'attribute_' + attribute.id"
                                                                                                                                                                                                                                                :aria-labelledby="'color-choice-' + index + '-label'"
                                                                                                                                                                                                                                                class="peer sr-only"
                                                                                                                                                                                                                                                @click="configure(attribute, $event.target.value)"
                                                                                                                                                                                                                                            />
                                                                                                                                                                                                                                        </v-field>

                                                                                                                                                                                                                                        <img
                                                                                                                                                                                                                                            :src="option.swatch_value"
                                                                                                                                                                                                                                            :title="option.label"
                                                                                                                                                                                                                                        />
                                                                                                                                                                                                                                    </label>

                                                                                                                                                                                                                                    <!-- Text/Button Swatch Options - Default for all other attributes -->
                                                                                                                                                                                                                                    <label 
                                                                                                                                                                                                                                        class="group relative flex h-fit min-w-fit cursor-pointer items-center justify-center rounded-lg border-2 border-gray-300 bg-white px-6 py-3 font-medium text-gray-900 hover:bg-gray-50 hover:border-gray-400 max-sm:h-fit max-sm:w-fit max-sm:px-4 max-sm:py-2.5 transition-all hover:shadow-md"
                                                                                                                                                                                                                                        :class="{'!border-navyBlue !bg-navyBlue text-white shadow-lg' : option.id == attribute.selectedValue }"
                                                                                                                                                                                                                                        :title="option.label"
                                                                                                                                                                                                                                        v-else
                                                                                                                                                                                                                                    >
                                                                                                                                                                                                                                        <v-field
                                                                                                                                                                                                                                            type="radio"
                                                                                                                                                                                                                                            :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                            :value="option.id"
                                                                                                                                                                                                                                            v-model="attribute.selectedValue"
                                                                                                                                                                                                                                            v-slot="{ field }"
                                                                                                                                                                                                                                            rules="required"
                                                                                                                                                                                                                                            :label="attribute.label"
                                                                                                                                                                                                                                            :aria-label="attribute.label"
                                                                                                                                                                                                                                        >
                                                                                                                                                                                                                                            <input
                                                                                                                                                                                                                                                type="radio"
                                                                                                                                                                                                                                                :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                                :value="option.id"
                                                                                                                                                                                                                                                v-bind="field"
                                                                                                                                                                                                                                                :id="'attribute_' + attribute.id"
                                                                                                                                                                                                                                                class="peer sr-only"
                                                                                                                                                                                                                                                :aria-labelledby="'color-choice-' + index + '-label'"
                                                                                                                                                                                                                                                @click="configure(attribute, $event.target.value)"
                                                                                                                                                                                                                                            />
                                                                                                                                                                                                                                        </v-field>

                                                                                                                                                                                                                                        <span class="text-base max-sm:text-sm font-semibold">
                                                                                                                                                                                                                                            @{{ option.label }}
                                                                                                                                                                                                                                        </span>

                                                                                                                                                                                                                                        <span
                                                                                                                                                                                                                                            class="pointer-events-none absolute -inset-px rounded-lg"
                                                                                                                                                                                                                                            role="presentation"
                                                                                                                                                                                                                                        >
                                                                                                                                                                                                                                        </span>
                                                                                                                                                                                                                                    </label>
                                                                                                                                                                                                                                </template>
                                                                                                                                                                                                                            </template>

                                                                                                                                                                                                                            <span
                                                                                                                                                                                                                                class="text-sm text-gray-600 max-sm:text-xs"
                                                                                                                                                                                                                                v-if="! attribute.options.length"
                                                                                                                                                                                                                            >
                                                                                                                                                                                                                                @lang('shop::app.products.view.type.configurable.select-above-options')
                                                                                                                                                                                                                            </span>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    </template>

                                                                                                                                                                                                                            <v-error-message
                                                                                                                                                                                                                                :name="'super_attribute[' + attribute.id + ']'"
                                                                                                                                                                                                                                v-slot="{ message }"
                                                                                                                                                                                                                            >
                                                                                                                                                                                                                                <p class="mt-1 text-xs italic text-red-500">
                                                                                                                                                                                                                                    @{{ message }}
                                                                                                                                                                                                                                </p>
                                                                                                                                                                                                                            </v-error-message>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                </script>

        <script type="module">
            let galleryImages = @json(product_image()->getGalleryImages($product));

            app.component('v-product-configurable-options', {
                template: '#v-product-configurable-options-template',

                props: ['errors'],

                data() {
                    return {
                        config: @json(app('Webkul\Product\Helpers\ConfigurableOption')->getConfigurationConfig($product)),

                        childAttributes: [],

                        possibleOptionVariant: null,

                        selectedOptionVariant: '',

                        galleryImages: [],
                    }
                },

                mounted() {
                    let attributes = JSON.parse(JSON.stringify(this.config)).attributes.slice();

                    let index = attributes.length;

                    while (index--) {
                        let attribute = attributes[index];

                        attribute.options = [];

                        attribute.disabled = false;

                        this.fillAttributeOptions(attribute);

                        attribute = Object.assign(attribute, {
                            childAttributes: this.childAttributes.slice(),
                            prevAttribute: attributes[index - 1],
                            nextAttribute: attributes[index + 1]
                        });

                        this.childAttributes.unshift(attribute);
                    }

                    // Store a copy of the original gallery images to preserve them
                    this.galleryImages = JSON.parse(JSON.stringify(galleryImages));

                    // Load all variant images on page load
                    this.loadAllVariantImages();
                },

                methods: {
                    configure(attribute, optionId) {
                        attribute.selectedValue = optionId;

                        let selectedAttributes = this.childAttributes.filter(attr => attr.selectedValue);

                        if (selectedAttributes.length == this.childAttributes.length) {
                            let intersection = null;

                            selectedAttributes.forEach(attr => {
                                let validOption = attr.options.find(o => o.id == attr.selectedValue);
                                if (validOption && validOption.allowedProducts) {
                                    if (intersection === null) {
                                        intersection = validOption.allowedProducts;
                                    } else {
                                        intersection = intersection.filter(id => validOption.allowedProducts.includes(id));
                                    }
                                }
                            });

                            if (intersection && intersection.length) {
                                this.possibleOptionVariant = intersection[0];
                                this.selectedOptionVariant = this.possibleOptionVariant;
                            } else {
                                this.possibleOptionVariant = null;
                                this.selectedOptionVariant = null;
                            }
                        } else {
                            // Check if color attribute is selected for partial image update
                            let colorAttribute = this.childAttributes.find(attr =>
                                attr.code === 'color' ||
                                attr.swatch_type === 'color' ||
                                attr.label?.toLowerCase().includes('color') ||
                                attr.label?.includes('لون')
                            );

                            if (colorAttribute && colorAttribute.selectedValue) {
                                let colorOption = colorAttribute.options.find(o => o.id == colorAttribute.selectedValue);
                                if (colorOption && colorOption.allowedProducts && colorOption.allowedProducts.length) {
                                    // Use the first matching product for this color
                                    this.possibleOptionVariant = colorOption.allowedProducts[0];
                                } else {
                                    this.possibleOptionVariant = null;
                                }
                            } else {
                                this.possibleOptionVariant = null;
                            }

                            this.selectedOptionVariant = null;
                        }

                        try {
                            this.reloadPrice();
                        } catch (e) {

                        }

                        this.reloadImages();
                    },

                    getPossibleOptionVariant(attribute, optionId) {
                        let matchedOptions = attribute.options.filter(option => option.id == optionId);

                        if (matchedOptions[0]?.allowedProducts) {
                            return matchedOptions[0].allowedProducts[0];
                        }

                        return undefined;
                    },

                    fillAttributeOptions(attribute) {
                        let options = this.config.attributes.find(tempAttribute => tempAttribute.id === attribute.id)?.options;

                        attribute.options = [{
                            'id': '',
                            'label': "@lang('shop::app.products.view.type.configurable.select-options')",
                            'products': []
                        }];

                        if (!options) {
                            return;
                        }

                        let index = 1;

                        for (let i = 0; i < options.length; i++) {
                            let allowedProducts = options[i].products.slice(0);

                            if (allowedProducts.length > 0) {
                                options[i].allowedProducts = allowedProducts;

                                attribute.options[index++] = options[i];
                            }
                        }
                    },

                    resetChildAttributes(attribute) {
                        if (!attribute.childAttributes) {
                            return;
                        }

                        attribute.childAttributes.forEach(function (set) {
                            set.selectedValue = null;

                            set.disabled = true;
                        });
                    },

                    clearAttributeSelection(attribute) {
                        if (!attribute) {
                            return;
                        }

                        attribute.selectedValue = null;

                        this.selectedOptionVariant = null;
                    },

                    reloadPrice() {
                        let selectedOptionCount = this.childAttributes.filter(attribute => attribute.selectedValue).length;

                        let finalPrice = document.querySelector('.final-price');

                        let regularPrice = document.querySelector('.regular-price');

                        let configVariant = this.config.variant_prices[this.possibleOptionVariant];

                        if (this.childAttributes.length == selectedOptionCount) {
                            document.querySelector('.price-label').style.display = 'none';

                            if (parseInt(configVariant.regular.price) > parseInt(configVariant.final.price)) {
                                regularPrice.style.display = 'block';

                                finalPrice.innerHTML = configVariant.final.formatted_price;

                                regularPrice.innerHTML = configVariant.regular.formatted_price;
                            } else {
                                finalPrice.innerHTML = configVariant.regular.formatted_price;

                                regularPrice.style.display = 'none';
                            }

                            this.$emitter.emit('configurable-variant-selected-event', this.possibleOptionVariant);
                        } else {
                            document.querySelector('.price-label').style.display = 'inline-block';

                            finalPrice.innerHTML = this.config.regular.formatted_price;

                            this.$emitter.emit('configurable-variant-selected-event', 0);
                        }
                    },

                    reloadImages() {
                        // Don't clear or rebuild gallery - keep all images always visible
                        // But update the main/active image to show the selected variant

                        const gallery = this.$parent?.$parent?.$refs?.gallery;

                        if (this.possibleOptionVariant && gallery) {
                            // Get the first image for the selected variant
                            const variantImages = this.config.variant_images[this.possibleOptionVariant];

                            // Use the gallery's own media.images array (not the global galleryImages)
                            // This ensures consistency since loadAllVariantImages modifies both
                            const currentGalleryImages = gallery.media?.images || [];

                            if (variantImages && variantImages.length > 0) {
                                const targetImage = variantImages[0];

                                // Helper to extract filename from URL for comparison
                                const getFilename = (url) => {
                                    if (!url) return '';
                                    return url.split('/').pop().split('?')[0];
                                };

                                const targetFilename = getFilename(targetImage.large_image_url) || getFilename(targetImage.original_image_url);

                                // Find the index of this image in the gallery's current images (compare by filename)
                                let imageIndex = currentGalleryImages.findIndex(img => {
                                    const imgFilename = getFilename(img.large_image_url) || getFilename(img.original_image_url);
                                    return imgFilename === targetFilename;
                                });

                                // Fallback: exact URL match
                                if (imageIndex === -1) {
                                    imageIndex = currentGalleryImages.findIndex(img =>
                                        img.original_image_url === targetImage.original_image_url ||
                                        img.large_image_url === targetImage.large_image_url
                                    );
                                }

                                // Get the image path to display
                                const imagePath = imageIndex !== -1
                                    ? (currentGalleryImages[imageIndex].large_image_url || currentGalleryImages[imageIndex].original_image_url)
                                    : (targetImage.large_image_url || targetImage.original_image_url);

                                // Update gallery directly without triggering loading state
                                // This avoids the issue where cached images don't fire @load event
                                gallery.baseFile.type = 'image';
                                gallery.baseFile.path = imagePath;

                                // Update activeIndex if we found the image in gallery
                                if (imageIndex !== -1) {
                                    gallery.activeIndex = imageIndex;
                                }

                                // Ensure loading state is off (in case it was stuck)
                                gallery.isMediaLoading = false;
                            } else {
                                // console.log('[DEBUG] No images found for variant', this.possibleOptionVariant);
                            }
                        }

                        this.$emitter.emit('configurable-variant-update-images-event', gallery?.media?.images || galleryImages);
                    },

                    /**
                     * Get the style for color circle (background image or solid color)
                     */
                    getColorCircleStyle(option) {
                        // Try to get the first variant image for this color option
                        if (option.allowedProducts && option.allowedProducts.length > 0) {
                            const firstVariantId = option.allowedProducts[0];
                            const variantImages = this.config.variant_images[firstVariantId];

                            if (variantImages && variantImages.length > 0) {
                                // Use the first variant image as background
                                return {
                                    'background-image': `url(${variantImages[0].small_image_url})`,
                                    'background-size': 'cover',
                                    'background-position': 'center'
                                };
                            }
                        }

                        // Fallback to solid color
                        return {
                            'background-color': option.swatch_value || option.label.toLowerCase()
                        };
                    },

                    /**
                     * Load all variant images into the gallery on page load
                     * Shows one image per color (not duplicated for each size variant)
                     */
                    loadAllVariantImages() {
                        // Get color attribute to group variants by color
                        let colorAttribute = this.childAttributes.find(attr =>
                            attr.code === 'color' ||
                            attr.swatch_type === 'color' ||
                            attr.label?.toLowerCase().includes('color') ||
                            attr.label?.includes('لون')
                        );

                        if (!colorAttribute || !colorAttribute.options) {
                            return;
                        }

                        // Collect one image per color option
                        let variantImagesByColor = [];

                        colorAttribute.options.forEach(colorOption => {
                            // Get the first variant for this color
                            if (colorOption.allowedProducts && colorOption.allowedProducts.length > 0) {
                                const firstVariantId = colorOption.allowedProducts[0];
                                const variantImages = this.config.variant_images[firstVariantId];

                                if (variantImages && variantImages.length > 0) {
                                    // Take only the first image for this color
                                    const firstImage = variantImages[0];

                                    // Check if we already have this image
                                    const exists = variantImagesByColor.find(img =>
                                        img.original_image_url === firstImage.original_image_url ||
                                        img.large_image_url === firstImage.large_image_url
                                    );

                                    if (!exists) {
                                        variantImagesByColor.push(firstImage);
                                    }
                                }
                            }
                        });

                        // Append variant images to gallery (AFTER original images)
                        variantImagesByColor.forEach(image => {
                            // Check if not already in galleryImages
                            const exists = galleryImages.find(img =>
                                img.original_image_url === image.original_image_url ||
                                img.large_image_url === image.large_image_url
                            );

                            if (!exists) {
                                galleryImages.push(image); // Changed from unshift to push
                            }
                        });

                        // Update the gallery component
                        if (galleryImages.length && this.$parent.$parent.$refs.gallery) {
                            this.$parent.$parent.$refs.gallery.media.images = [...galleryImages];
                        }
                    },
                }
            });

        </script>
    @endpush

@endif