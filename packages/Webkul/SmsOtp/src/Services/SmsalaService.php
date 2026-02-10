<?php

namespace Webkul\SmsOtp\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsalaService
{
    /**
     * SMSala API endpoint.
     */
    protected string $apiUrl = 'https://api.smsala.com/api/SendSMS';

    /**
     * API credentials from config.
     */
    protected string $apiId;
    protected string $apiPassword;
    protected string $senderId;

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        $this->apiId = config('smsotp.smsala.api_id', '');
        $this->apiPassword = config('smsotp.smsala.api_password', '');
        $this->senderId = config('smsotp.smsala.sender_id', '');
    }

    /**
     * Send SMS to a phone number.
     */
    public function send(string $phone, string $message): array
    {
        try {
            $response = Http::asForm()->post($this->apiUrl, [
                'api_id' => $this->apiId,
                'api_password' => $this->apiPassword,
                'sms_type' => 'T', // Transactional
                'encoding' => 'T', // Text
                'sender_id' => $this->senderId,
                'phonenumber' => $this->formatPhone($phone),
                'textmessage' => $message,
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === 'success') {
                Log::info('SMS sent successfully', ['phone' => $phone]);

                return [
                    'success' => true,
                    'message' => 'SMS sent successfully',
                    'data' => $result,
                ];
            }

            Log::error('SMS sending failed', ['phone' => $phone, 'response' => $result]);

            return [
                'success' => false,
                'message' => $result['message'] ?? 'Failed to send SMS',
                'data' => $result,
            ];
        } catch (\Exception $e) {
            Log::error('SMS sending exception', ['phone' => $phone, 'error' => $e->getMessage()]);

            return [
                'success' => false,
                'message' => 'SMS service error: ' . $e->getMessage(),
                'data' => null,
            ];
        }
    }

    /**
     * Send OTP to a phone number.
     */
    public function sendOtp(string $phone, string $code): array
    {
        $message = trans('smsotp::app.otp-message', ['code' => $code]);

        return $this->send($phone, $message);
    }

    /**
     * Format phone number for API.
     */
    protected function formatPhone(string $phone): string
    {
        // Remove any non-numeric characters except +
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        // If starts with 0, assume Egyptian number and replace with +20
        if (str_starts_with($phone, '0')) {
            $phone = '+20' . substr($phone, 1);
        }

        // If doesn't start with +, add it
        if (!str_starts_with($phone, '+')) {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
