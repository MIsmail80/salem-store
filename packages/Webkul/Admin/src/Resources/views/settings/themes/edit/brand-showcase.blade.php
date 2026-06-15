<v-brand-showcase :errors="errors">
    <x-admin::shimmer.settings.themes.product-carousel />
</v-brand-showcase>

<!-- Brand Showcase Vue Component -->
@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-brand-showcase-template"
    >
        <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
            <div class="box-shadow rounded bg-white p-4 dark:bg-gray-900">
                <div class="mb-4 flex items-center justify-between gap-x-2.5">
                    <div class="flex flex-col gap-1">
                        <p class="text-base font-semibold text-gray-800 dark:text-white">
                            @lang('admin::app.settings.themes.edit.brand-showcase')
                        </p>

                        <p class="text-xs font-medium text-gray-500 dark:text-gray-300">
                            @lang('admin::app.settings.themes.edit.brand-showcase-description')
                        </p>
                    </div>
                </div>

                <!-- Brand Name -->
                <x-admin::form.control-group class="mb-2.5">
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.settings.themes.edit.brand-name')
                    </x-admin::form.control-group.label>

                    <v-field
                        type="text"
                        name="{{ $currentLocale->code }}[options][brand_name]"
                        value="{{ $theme->translate($currentLocale->code)->options['brand_name'] ?? '' }}"
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                        :class="[errors['{{ $currentLocale->code }}[options][brand_name]'] ? 'border border-red-600 hover:border-red-600' : '']"
                        rules="required"
                        label="@lang('admin::app.settings.themes.edit.brand-name')"
                        placeholder="e.g. echo"
                    >
                    </v-field>

                    <x-admin::form.control-group.error control-name="{{ $currentLocale->code }}[options][brand_name]" />
                </x-admin::form.control-group>

                <!-- Brand Subtitle -->
                <x-admin::form.control-group class="mb-2.5">
                    <x-admin::form.control-group.label>
                        @lang('admin::app.settings.themes.edit.brand-subtitle')
                    </x-admin::form.control-group.label>

                    <v-field
                        type="text"
                        name="{{ $currentLocale->code }}[options][brand_subtitle]"
                        value="{{ $theme->translate($currentLocale->code)->options['brand_subtitle'] ?? '' }}"
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                        label="@lang('admin::app.settings.themes.edit.brand-subtitle')"
                        placeholder="e.g. FAMILY"
                    >
                    </v-field>

                    <x-admin::form.control-group.error control-name="{{ $currentLocale->code }}[options][brand_subtitle]" />
                </x-admin::form.control-group>

                <!-- Brand Accent Color -->
                <x-admin::form.control-group class="mb-2.5">
                    <x-admin::form.control-group.label>
                        @lang('admin::app.settings.themes.edit.brand-color')
                    </x-admin::form.control-group.label>

                    <div class="flex items-center gap-3">
                        <input
                            type="color"
                            name="{{ $currentLocale->code }}[options][brand_color]"
                            value="{{ $theme->translate($currentLocale->code)->options['brand_color'] ?? '#e63946' }}"
                            class="h-10 w-16 cursor-pointer rounded-md border border-gray-300 p-1 dark:border-gray-800"
                        />
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            @lang('admin::app.settings.themes.edit.brand-color-hint')
                        </span>
                    </div>
                </x-admin::form.control-group>

                <span class="mb-4 mt-4 block w-full border-b dark:border-gray-800"></span>

                <!-- Parent Category ID -->
                <x-admin::form.control-group class="mb-2.5">
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.settings.themes.edit.parent-id')
                    </x-admin::form.control-group.label>

                    <v-field
                        type="text"
                        name="{{ $currentLocale->code }}[options][filters][parent_id]"
                        value="{{ $theme->translate($currentLocale->code)->options['filters']['parent_id'] ?? '' }}"
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                        :class="[errors['{{ $currentLocale->code }}[options][filters][parent_id]'] ? 'border border-red-600 hover:border-red-600' : '']"
                        rules="required|numeric"
                        label="@lang('admin::app.settings.themes.edit.parent-id')"
                        placeholder="e.g. 5"
                    >
                    </v-field>

                    <p class="mt-1 text-xs text-gray-500">
                        @lang('admin::app.settings.themes.edit.parent-id-hint')
                    </p>

                    <x-admin::form.control-group.error control-name="{{ $currentLocale->code }}[options][filters][parent_id]" />
                </x-admin::form.control-group>

                <!-- Sort -->
                <x-admin::form.control-group class="mb-2.5">
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.settings.themes.edit.sort')
                    </x-admin::form.control-group.label>

                    <v-field
                        name="{{ $currentLocale->code }}[options][filters][sort]"
                        value="{{ $theme->translate($currentLocale->code)->options['filters']['sort'] ?? 'asc' }}"
                        v-slot="{ field }"
                        rules="required"
                        label="@lang('admin::app.settings.themes.edit.sort')"
                    >
                        <select
                            name="{{ $currentLocale->code }}[options][filters][sort]"
                            v-bind="field"
                            class="custom-select flex min-h-[39px] w-full rounded-md border bg-white px-3 py-1.5 text-sm font-normal text-gray-600 transition-all hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400"
                        >
                            <option value="asc">@lang('admin::app.settings.themes.edit.asc')</option>
                            <option value="desc">@lang('admin::app.settings.themes.edit.desc')</option>
                        </select>
                    </v-field>

                    <x-admin::form.control-group.error control-name="{{ $currentLocale->code }}[options][filters][sort]" />
                </x-admin::form.control-group>

                <!-- Limit -->
                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required">
                        @lang('admin::app.settings.themes.edit.limit')
                    </x-admin::form.control-group.label>

                    <v-field
                        type="text"
                        name="{{ $currentLocale->code }}[options][filters][limit]"
                        value="{{ $theme->translate($currentLocale->code)->options['filters']['limit'] ?? 8 }}"
                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                        :class="[errors['{{ $currentLocale->code }}[options][filters][limit]'] ? 'border border-red-600 hover:border-red-600' : '']"
                        rules="required|min_value:1|max_value:24"
                        label="@lang('admin::app.settings.themes.edit.limit')"
                        placeholder="8"
                    >
                    </v-field>

                    <x-admin::form.control-group.error control-name="{{ $currentLocale->code }}[options][filters][limit]" />
                </x-admin::form.control-group>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-brand-showcase', {
            template: '#v-brand-showcase-template',

            props: ['errors'],
        });
    </script>
@endPushOnce
