<?php

namespace Webkul\Shop\Http\Controllers\Customer;

use Cookie;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Webkul\Core\Repositories\SubscribersListRepository;
use Webkul\Customer\Repositories\CustomerGroupRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Shop\Http\Requests\Customer\RegistrationRequest;
use Webkul\Shop\Mail\Customer\EmailVerificationNotification;
use Webkul\Shop\Mail\Customer\RegistrationNotification;
use Webkul\SmsOtp\Services\SmsMisrService;
use Webkul\SmsOtp\Services\SmsalaService;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected CustomerGroupRepository $customerGroupRepository,
        protected SubscribersListRepository $subscriptionRepository
    ) {
    }

    /**
     * Opens up the user's sign up form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('shop::customers.sign-up');
    }

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $registrationRequest)
    {
        $customerGroup = core()->getConfigData('customer.settings.create_new_account_options.default_group');

        // Parse full_name into first_name and last_name
        $fullName = trim($registrationRequest->input('full_name'));
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $registrationRequest->input('phone'),
            'email' => null, // Email removed from registration
            'password' => bcrypt($registrationRequest->input('password')),
            'password_confirmation' => $registrationRequest->input('password_confirmation'),
            'api_token' => Str::random(80),
            'is_verified' => false, // Will be verified via OTP
            'customer_group_id' => $this->customerGroupRepository->findOneWhere(['code' => $customerGroup])->id,
            'channel_id' => core()->getCurrentChannel()->id,
            'token' => null,
            'subscribed_to_news_letter' => false,
        ];

        Event::dispatch('customer.registration.before');

        $customer = $this->customerRepository->create($data);

        Event::dispatch('customer.create.after', $customer);
        Event::dispatch('customer.registration.after', $customer);

        // Send OTP for phone verification
        try {
            $otp = \Webkul\SmsOtp\Models\Otp::createForPhone($customer->phone);
            $smsService = $this->resolveSmsService();
            $smsService->sendOtp($customer->phone, $otp->code);
        } catch (\Exception $e) {
            report($e);
            // Continue even if SMS fails - user can resend
        }

        // Store phone in session for verification page
        session()->put('otp_phone', $customer->phone);
        session()->put('otp_customer_id', $customer->id);

        session()->flash('info', trans('smsotp::app.otp-sent'));

        return redirect()->route('shop.customer.verify-phone');
    }

    /**
     * Method to verify account.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function verifyAccount($token)
    {
        $customer = $this->customerRepository->findOneByField('token', $token);

        if ($customer) {
            $this->customerRepository->update([
                'is_verified' => 1,
                'token' => null,
            ], $customer->id);

            if ((bool) core()->getConfigData('emails.general.notifications.emails.general.notifications.registration')) {
                Mail::queue(new RegistrationNotification($customer));
            }

            $this->customerRepository->syncNewRegisteredCustomerInformation($customer);

            session()->flash('success', trans('shop::app.customers.signup-form.verified'));
        } else {
            session()->flash('warning', trans('shop::app.customers.signup-form.verify-failed'));
        }

        return redirect()->route('shop.customer.session.index');
    }

    /**
     * Resend verification email.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function resendVerificationEmail($email)
    {
        $verificationData = [
            'email' => $email,
            'token' => md5(uniqid(rand(), true)),
        ];

        $customer = $this->customerRepository->findOneByField('email', $email);

        $this->customerRepository->update(['token' => $verificationData['token']], $customer->id);

        try {
            Mail::queue(new EmailVerificationNotification($verificationData));

            if (Cookie::has('enable-resend')) {
                \Cookie::queue(\Cookie::forget('enable-resend'));
            }

            if (Cookie::has('email-for-resend')) {
                \Cookie::queue(\Cookie::forget('email-for-resend'));
            }
        } catch (\Exception $e) {
            report($e);

            session()->flash('error', trans('shop::app.customers.signup-form.verification-not-sent'));

            return redirect()->back();
        }

        session()->flash('success', trans('shop::app.customers.signup-form.verification-sent'));

        return redirect()->back();
    }

    /**
     * Show phone OTP verification page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showVerifyPhonePage()
    {
        $phone = session('otp_phone');
        $customerId = session('otp_customer_id');

        if (!$phone || !$customerId) {
            return redirect()->route('shop.customers.register.index');
        }

        return view('shop::customers.verify-phone', compact('phone'));
    }

    /**
     * Verify phone OTP and activate customer account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyPhone()
    {
        $phone = session('otp_phone');
        $customerId = session('otp_customer_id');

        if (!$phone || !$customerId) {
            return redirect()->route('shop.customers.register.index');
        }

        $code = request()->input('otp_code');

        if (!$code || strlen($code) !== 6) {
            session()->flash('error', trans('smsotp::app.invalid-otp'));
            return redirect()->back();
        }

        $otp = \Webkul\SmsOtp\Models\Otp::verify($phone, $code);

        if (!$otp) {
            session()->flash('error', trans('smsotp::app.otp-invalid'));
            return redirect()->back();
        }

        // Verify the customer
        $customer = $this->customerRepository->find($customerId);

        if ($customer) {
            $this->customerRepository->update([
                'is_verified' => 1,
            ], $customer->id);

            // Clear session
            session()->forget(['otp_phone', 'otp_customer_id']);

            // Log the customer in
            auth()->guard('customer')->login($customer);

            session()->flash('success', trans('shop::app.customers.signup-form.success'));

            return redirect()->route('shop.home.index');
        }

        session()->flash('error', trans('smsotp::app.otp-verify-failed'));
        return redirect()->back();
    }

    /**
     * Resend OTP for phone verification.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendOtp()
    {
        $phone = session('otp_phone');

        if (!$phone) {
            return redirect()->route('shop.customers.register.index');
        }

        try {
            $otp = \Webkul\SmsOtp\Models\Otp::createForPhone($phone);
            $smsService = $this->resolveSmsService();
            $smsService->sendOtp($phone, $otp->code);

            session()->flash('success', trans('smsotp::app.otp-sent'));
        } catch (\Exception $e) {
            report($e);
            session()->flash('error', trans('smsotp::app.otp-send-failed'));
        }

        return redirect()->back();
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
