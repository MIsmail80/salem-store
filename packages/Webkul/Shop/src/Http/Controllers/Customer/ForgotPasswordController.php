<?php

namespace Webkul\Shop\Http\Controllers\Customer;

use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Shop\Http\Requests\Customer\ForgotPasswordRequest;
use Webkul\Customer\Models\Customer;
use Webkul\SmsOtp\Models\Otp;
use Webkul\SmsOtp\Services\SmsMisrService;
use Webkul\SmsOtp\Services\SmsalaService;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('shop::customers.forgot-password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ForgotPasswordRequest $request)
    {
        $request->validated();

        try {
            $customer = Customer::where('phone', $request->phone)->first();

            if (! $customer) {
                return redirect()->route('shop.customers.forgot_password.create')
                    ->withInput($request->only(['phone']))
                    ->withErrors([
                        'phone' => trans('shop::app.customers.forgot-password.email-not-exist'),
                    ]);
            }

            // Generate OTP
            $otp = Otp::createForPhone($customer->phone);
            
            // Send OTP
            $smsService = $this->resolveSmsService();
            $smsService->sendOtp($customer->phone, $otp->code);

            session()->put('reset_phone', $customer->phone);
            session()->flash('success', trans('smsotp::app.otp-sent'));

            return redirect()->route('shop.customers.reset_password.create');

        } catch (\Exception $e) {
            report($e);

            session()->flash('error', $e->getMessage());

            return redirect()->route('shop.customers.forgot_password.create');
        }
    }

    /**
     * Resolve the active SMS service based on the configured driver.
     */
    protected function resolveSmsService()
    {
        return match (config('smsotp.driver', 'smsmisr')) {
            'smsala' => app(SmsalaService::class),
            default  => app(SmsMisrService::class),
        };
    }
}
