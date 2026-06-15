<?php

namespace Webkul\SmsOtp\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsMisrService
{
    /**
     * SmsMisr OTP API endpoint.
     */
    protected string $apiUrl = 'https://smsmisr.com/api/OTP/';

    /**
     * Response code constants.
     */
    const CODE_SUCCESS             = '4901';
    const CODE_INVALID_CREDENTIALS = '4903';
    const CODE_INVALID_SENDER      = '4904';
    const CODE_INVALID_MOBILE      = '4905';
    const CODE_INSUFFICIENT_CREDIT = '4906';
    const CODE_SERVER_UPDATING     = '4907';
    const CODE_INVALID_OTP         = '4908';
    const CODE_INVALID_TEMPLATE    = '4909';
    const CODE_INVALID_ENVIRONMENT = '4912';

    /**
     * Environment constants.
     */
    const ENV_LIVE = 1;
    const ENV_TEST = 2;

    /**
     * API credentials and config from smsotp config.
     */
    protected string $username;
    protected string $password;
    protected string $sender;
    protected string $templateToken;
    protected int $environment;

    /**
     * Create a new SmsMisrService instance.
     */
    public function __construct()
    {
        $this->username      = config('smsotp.smsmisr.username', '');
        $this->password      = config('smsotp.smsmisr.password', '');
        $this->templateToken = config('smsotp.smsmisr.template_token', '');
        $this->environment   = config('smsotp.smsmisr.environment', self::ENV_TEST);

        // Use the testing sender when in test mode, live sender otherwise
        $this->sender = $this->environment === self::ENV_TEST
            ? config('smsotp.smsmisr.test_sender', 'b611afb996655a94c8e942a823f1421de42bf8335d24ba1f84c437b2ab11ca27')
            : config('smsotp.smsmisr.sender', '');
    }

    /**
     * Send an OTP code to the given phone number via SmsMisr.
     */
    public function sendOtp(string $phone, string $otp): array
    {
        $formattedPhone = $this->formatPhone($phone);

        try {
            $response = Http::asForm()->post($this->apiUrl, [
                'environment' => $this->environment,
                'username'    => $this->username,
                'password'    => $this->password,
                'sender'      => $this->sender,
                'mobile'      => $formattedPhone,
                'template'    => $this->templateToken,
                'otp'         => $otp,
            ]);

            $result = $response->json();

            Log::info('SmsMisr OTP response', [
                'phone'       => $phone,
                'environment' => $this->environment === self::ENV_TEST ? 'test' : 'live',
                'response'    => $result,
            ]);

            if (isset($result['code']) && $result['code'] === self::CODE_SUCCESS) {
                return [
                    'success' => true,
                    'message' => 'OTP sent successfully',
                    'sms_id'  => $result['SMSID'] ?? null,
                    'cost'    => $result['Cost'] ?? null,
                    'data'    => $result,
                ];
            }

            $errorMessage = $this->resolveErrorMessage($result['code'] ?? null);

            Log::error('SmsMisr OTP sending failed', [
                'phone'   => $phone,
                'code'    => $result['code'] ?? 'unknown',
                'message' => $errorMessage,
            ]);

            return [
                'success' => false,
                'message' => $errorMessage,
                'code'    => $result['code'] ?? null,
                'data'    => $result,
            ];
        } catch (\Exception $e) {
            Log::error('SmsMisr OTP exception', [
                'phone' => $phone,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'SMS service error: ' . $e->getMessage(),
                'data'    => null,
            ];
        }
    }

    /**
     * Check whether the service is running in test mode.
     */
    public function isTestMode(): bool
    {
        return $this->environment === self::ENV_TEST;
    }

    /**
     * Format a phone number for SmsMisr (Egyptian format: 201XXXXXXXXX).
     */
    protected function formatPhone(string $phone): string
    {
        // Strip all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Egyptian number starting with 0 → replace with 20
        if (str_starts_with($phone, '0')) {
            $phone = '20' . substr($phone, 1);
        }

        // If it doesn't already start with 20, prepend it
        if (! str_starts_with($phone, '20')) {
            $phone = '20' . $phone;
        }

        return $phone;
    }

    /**
     * Resolve a human-readable error message from an SmsMisr response code.
     */
    protected function resolveErrorMessage(?string $code): string
    {
        return match ($code) {
            self::CODE_INVALID_CREDENTIALS => 'Invalid username or password.',
            self::CODE_INVALID_SENDER      => 'Invalid sender ID.',
            self::CODE_INVALID_MOBILE      => 'Invalid mobile number.',
            self::CODE_INSUFFICIENT_CREDIT => 'Insufficient credit.',
            self::CODE_SERVER_UPDATING     => 'Server is currently updating. Please try again shortly.',
            self::CODE_INVALID_OTP         => 'Invalid OTP value.',
            self::CODE_INVALID_TEMPLATE    => 'Invalid template token.',
            self::CODE_INVALID_ENVIRONMENT => 'Invalid environment value.',
            default                        => 'Failed to send OTP. Please try again.',
        };
    }
}
