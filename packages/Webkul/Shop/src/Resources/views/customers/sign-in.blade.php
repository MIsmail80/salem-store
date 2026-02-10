<!-- SEO Meta Content -->
@push('meta')
<meta name="description" content="@lang('shop::app.customers.login-form.page-title')" />

<meta name="keywords" content="@lang('shop::app.customers.login-form.page-title')" />
@endPush

<x-shop::layouts :has-header="false" :has-feature="false" :has-footer="false">
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.login-form.page-title')
        </x-slot>

        <!-- Two-Tone Design: Dark Header + White Form -->
        <div class="min-h-screen flex flex-col">
            <!-- Dark Header Section with Logo (matching homepage) -->
            <div
                class="bg-gradient-to-b from-brandBlack via-brandBlack to-brandBlack-light shadow-[0_5px_20px_rgba(196,163,90,0.25)] border-b border-gold/20">
                <div class="container min-h-[100px] flex items-center justify-center max-1180:px-5">
                    {!! view_render_event('bagisto.shop.customers.login.logo.before') !!}

                    <a href="{{ route('shop.home.index') }}"
                        aria-label="@lang('shop::app.customers.login-form.bagisto')">
                        <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                            alt="{{ config('app.name') }}" class="max-h-14 w-auto object-contain">
                    </a>

                    {!! view_render_event('bagisto.shop.customers.login.logo.after') !!}
                </div>
            </div>

            <!-- White Form Section -->
            <div class="flex-1 bg-white">
                <div class="container py-12 max-1180:px-5 max-md:py-8">
                    <!-- Form Container -->
                    <div
                        class="m-auto w-full max-w-[870px] rounded-xl border border-zinc-200 p-16 px-[90px] max-md:px-8 max-md:py-8 max-sm:border-none max-sm:p-0">
                        <h1 class="font-dmserif text-4xl max-md:text-3xl max-sm:text-xl">
                            @lang('shop::app.customers.login-form.page-title')
                        </h1>

                        <p class="mt-4 text-xl text-zinc-500 max-sm:mt-0 max-sm:text-sm">
                            @lang('smsotp::app.login-form-text')
                        </p>

                        {!! view_render_event('bagisto.shop.customers.login.before') !!}

                        <div class="mt-14 rounded max-sm:mt-8">
                            <x-shop::form :action="route('shop.customer.session.create')">

                                {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                                <!-- Phone Number -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required">
                                        @lang('smsotp::app.phone')
                                    </x-shop::form.control-group.label>

                                    <x-shop::form.control-group.control type="tel"
                                        class="px-6 py-4 max-md:py-3 max-sm:py-2" name="phone"
                                        rules="required|min:10|max:20" value="" :label="trans('smsotp::app.phone')"
                                        placeholder="01xxxxxxxxx" :aria-label="trans('smsotp::app.phone')"
                                        aria-required="true" />

                                    <x-shop::form.control-group.error control-name="phone" />
                                </x-shop::form.control-group>

                                <!-- Password -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required">
                                        @lang('shop::app.customers.login-form.password')
                                    </x-shop::form.control-group.label>

                                    <x-shop::form.control-group.control type="password"
                                        class="px-6 py-4 max-md:py-3 max-sm:py-2" id="password" name="password"
                                        rules="required|min:6" value=""
                                        :label="trans('shop::app.customers.login-form.password')"
                                        :placeholder="trans('shop::app.customers.login-form.password')"
                                        :aria-label="trans('shop::app.customers.login-form.password')"
                                        aria-required="true" />

                                    <x-shop::form.control-group.error control-name="password" />
                                </x-shop::form.control-group>

                                <div class="flex justify-between">
                                    <div class="flex select-none items-center gap-1.5">
                                        <input type="checkbox" id="show-password" class="peer hidden"
                                            onchange="switchVisibility()" />

                                        <label
                                            class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue max-sm:text-xl"
                                            for="show-password"></label>

                                        <label
                                            class="cursor-pointer select-none text-base text-zinc-500 max-sm:text-sm ltr:pl-0 rtl:pr-0"
                                            for="show-password">
                                            @lang('shop::app.customers.login-form.show-password')
                                        </label>
                                    </div>

                                    <div class="block">
                                        <a href="{{ route('shop.customers.forgot_password.create') }}"
                                            class="cursor-pointer text-base text-black max-sm:text-sm">
                                            <span>
                                                @lang('shop::app.customers.login-form.forgot-pass')
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Captcha -->
                                @if (core()->getConfigData('customer.captcha.credentials.status'))
                                    <div class="mt-5 flex">
                                        {!! \Webkul\Customer\Facades\Captcha::render() !!}
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <div
                                    class="mt-8 flex flex-wrap items-center gap-9 max-sm:justify-center max-sm:gap-5 max-sm:text-center">
                                    <button
                                        class="primary-button m-0 mx-auto block w-full max-w-[374px] rounded-2xl px-11 py-4 text-center text-base max-md:max-w-full max-md:rounded-lg max-md:py-3 max-sm:py-1.5 ltr:ml-0 rtl:mr-0"
                                        type="submit">
                                        @lang('shop::app.customers.login-form.button-title')
                                    </button>

                                    {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}
                                </div>
                            </x-shop::form>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.login.after') !!}

                        <p class="mt-5 font-medium text-zinc-500 max-sm:text-center max-sm:text-sm">
                            @lang('shop::app.customers.login-form.new-customer')

                            <a class="text-navyBlue" href="{{ route('shop.customers.register.index') }}">
                                @lang('shop::app.customers.login-form.create-your-account')
                            </a>
                        </p>
                    </div>

                    <p class="mb-4 mt-8 text-center text-xs text-zinc-500">
                        @lang('shop::app.customers.login-form.footer', ['current_year' => date('Y')])
                    </p>
                </div>
            </div>
        </div>

        @push('scripts')
            {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}

            <script>
                function switchVisibility() {
                    let passwordField = document.getElementById("password");

                    passwordField.type = passwordField.type === "password"
                        ? "text"
                        : "password";
                }
            </script>
        @endpush
</x-shop::layouts>