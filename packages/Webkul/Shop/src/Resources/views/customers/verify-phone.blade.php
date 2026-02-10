<!-- SEO Meta Content -->
@push('meta')
<meta name="description" content="@lang('smsotp::app.verify-phone')" />
<meta name="keywords" content="@lang('smsotp::app.verify-phone')" />
@endPush

<x-shop::layouts :has-header="false" :has-feature="false" :has-footer="false">
    <!-- Page Title -->
    <x-slot:title>
        @lang('smsotp::app.verify-phone')
        </x-slot>

        <!-- Two-Tone Design: Dark Header + White Form -->
        <div class="min-h-screen flex flex-col">
            <!-- Dark Header Section with Logo (matching homepage) -->
            <div
                class="bg-gradient-to-b from-brandBlack via-brandBlack to-brandBlack-light shadow-[0_5px_20px_rgba(196,163,90,0.25)] border-b border-gold/20">
                <div class="container min-h-[100px] flex items-center justify-center max-1180:px-5">
                    <a href="{{ route('shop.home.index') }}"
                        aria-label="@lang('shop::app.customers.login-form.bagisto')">
                        <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                            alt="{{ config('app.name') }}" class="max-h-14 w-auto object-contain">
                    </a>
                </div>
            </div>

            <!-- White Form Section -->
            <div class="flex-1 bg-white">
                <div class="container py-12 max-1180:px-5 max-md:py-8">
                    <!-- Form Container -->
                    <div
                        class="m-auto w-full max-w-[500px] rounded-xl border border-zinc-200 p-16 px-[60px] max-md:px-8 max-md:py-8 max-sm:border-none max-sm:p-0">

                        <!-- Phone Icon -->
                        <div class="flex justify-center mb-6">
                            <div class="w-20 h-20 rounded-full bg-gold/10 flex items-center justify-center">
                                <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <h1 class="font-dmserif text-3xl text-center max-md:text-2xl">
                            @lang('smsotp::app.verify-phone')
                        </h1>

                        <p class="mt-4 text-center text-zinc-500 max-sm:text-sm">
                            @lang('smsotp::app.verify-phone-text', ['phone' => $phone])
                        </p>

                        <div class="mt-10 rounded max-sm:mt-6">
                            <x-shop::form :action="route('shop.customer.verify-phone.submit')">

                                <!-- OTP Code -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required text-center block">
                                        @lang('smsotp::app.otp-code')
                                    </x-shop::form.control-group.label>

                                    <x-shop::form.control-group.control type="text"
                                        class="px-6 py-4 text-center text-2xl tracking-[0.5em] font-mono"
                                        name="otp_code" rules="required|min:6|max:6" value="" maxlength="6"
                                        :label="trans('smsotp::app.otp-code')" placeholder="000000"
                                        :aria-label="trans('smsotp::app.otp-code')" aria-required="true"
                                        autocomplete="one-time-code" inputmode="numeric" />

                                    <x-shop::form.control-group.error control-name="otp_code" />
                                </x-shop::form.control-group>

                                <!-- Submit Button -->
                                <div class="mt-8">
                                    <button
                                        class="primary-button m-0 mx-auto block w-full rounded-2xl px-11 py-4 text-center text-base max-md:rounded-lg max-md:py-3"
                                        type="submit">
                                        @lang('smsotp::app.verify-otp')
                                    </button>
                                </div>

                            </x-shop::form>

                            <!-- Resend OTP -->
                            <div class="mt-6 text-center">
                                <p class="text-zinc-500 text-sm mb-2">
                                    @lang('smsotp::app.didnt-receive-otp')
                                </p>
                                <form action="{{ route('shop.customer.resend-otp') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-navyBlue font-semibold hover:underline">
                                        @lang('smsotp::app.resend-otp')
                                    </button>
                                </form>
                            </div>
                        </div>

                        <p class="mt-8 text-center font-medium text-zinc-500 max-sm:text-sm">
                            @lang('smsotp::app.wrong-number')
                            <a class="text-navyBlue" href="{{ route('shop.customers.register.index') }}">
                                @lang('smsotp::app.start-over')
                            </a>
                        </p>
                    </div>

                    <p class="mb-4 mt-8 text-center text-xs text-zinc-500">
                        @lang('shop::app.customers.login-form.footer', ['current_year' => date('Y')])
                    </p>
                </div>
            </div>
        </div>
</x-shop::layouts>