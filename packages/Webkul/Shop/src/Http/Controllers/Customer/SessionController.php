<?php

namespace Webkul\Shop\Http\Controllers\Customer;

use Illuminate\Support\Facades\Event;
use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Shop\Http\Requests\Customer\LoginRequest;
use Webkul\SmsOtp\Services\SmsMisrService;
use Webkul\SmsOtp\Services\SmsalaService;

class SessionController extends Controller
{
    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        if (auth()->guard('customer')->check()) {
            return redirect()->route('shop.home.index');
        }

        return view('shop::customers.sign-in');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $loginRequest)
    {
        if (!auth()->guard('customer')->attempt($loginRequest->only(['phone', 'password']))) {
            session()->flash('error', trans('shop::app.customers.login-form.invalid-credentials'));

            return redirect()->back();
        }

        $customer = auth()->guard('customer')->user();

        if (!$customer->status) {
            auth()->guard('customer')->logout();

            session()->flash('warning', trans('shop::app.customers.login-form.not-activated'));

            return redirect()->back();
        }

        // Check if customer is verified (phone OTP verified)
        if (!$customer->is_verified) {
            auth()->guard('customer')->logout();

            // Send OTP for verification
            try {
                $otp = \Webkul\SmsOtp\Models\Otp::createForPhone($customer->phone);
                $smsService = $this->resolveSmsService();
                $smsService->sendOtp($customer->phone, $otp->code);
            } catch (\Exception $e) {
                report($e);
            }

            // Store phone in session for verification page
            session()->put('otp_phone', $customer->phone);
            session()->put('otp_customer_id', $customer->id);

            session()->flash('warning', trans('smsotp::app.account-not-verified'));

            return redirect()->route('shop.customer.verify-phone');
        }

        /**
         * Event passed to prepare cart after login.
         */
        Event::dispatch('customer.after.login', $customer);

        if (core()->getConfigData('customer.settings.login_options.redirected_to_page') == 'account') {
            return redirect()->route('shop.customers.account.profile.index');
        }

        return redirect()->route('shop.home.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = auth()->guard('customer')->user()->id;

        auth()->guard('customer')->logout();

        Event::dispatch('customer.after.logout', $id);

        return redirect()->route('shop.home.index');
    }

    /**
     * Resolve the active SMS service based on the configured driver.
     */
    protected function resolveSmsService(): SmsMisrService|SmsalaService
    {
        return match (config('smsotp.driver', 'smsmisr')) {
            'smsala' => app(SmsalaService::class),
            default  => app(SmsMisrService::class),
        };
    }
}
