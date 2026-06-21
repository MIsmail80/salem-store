<?php

namespace Webkul\Shop\Http\Controllers\Customer;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Shop\Http\Controllers\Controller;
use Webkul\SmsOtp\Models\Otp;

class ResetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected CustomerRepository $customerRepository) {}

    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (! session()->has('reset_phone')) {
            return redirect()->route('shop.customers.forgot_password.create');
        }

        return view('shop::customers.reset-password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        try {
            $this->validate(request(), [
                'phone'                 => 'required',
                'otp_code'              => 'required|string|size:6',
                'password'              => 'required|confirmed|min:6',
            ]);

            $phone = request('phone');
            $otpCode = request('otp_code');

            $otp = Otp::verify($phone, $otpCode);

            if (! $otp) {
                return back()
                    ->withInput(request(['phone']))
                    ->withErrors([
                        'otp_code' => trans('smsotp::app.otp-invalid'),
                    ]);
            }

            $customer = $this->customerRepository->findOneByField('phone', $phone);

            if (! $customer) {
                return back()
                    ->withInput(request(['phone']))
                    ->withErrors([
                        'phone' => trans('shop::app.customers.forgot-password.email-not-exist'),
                    ]);
            }

            $customer->password = Hash::make(request('password'));
            $customer->setRememberToken(Str::random(60));
            $customer->save();

            Event::dispatch('customer.password.update.after', $customer);

            // Log the user in
            auth()->guard('customer')->login($customer);
            
            // Forget the reset phone session
            session()->forget('reset_phone');

            // Set success flash message
            session()->flash('success', trans('shop::app.customers.reset-password.success') ?? 'Password has been reset successfully.');

            return redirect()->route('shop.customers.account.profile.index');

        } catch (\Exception $e) {
            session()->flash('error', trans($e->getMessage()));

            return redirect()->back();
        }
    }
}
