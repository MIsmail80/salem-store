<?php

return [
    /**
     * SMSala API Configuration
     */
    'smsala' => [
        'api_id' => env('SMSALA_API_ID', ''),
        'api_password' => env('SMSALA_API_PASSWORD', ''),
        'sender_id' => env('SMSALA_SENDER_ID', ''),
    ],

    /**
     * OTP Configuration
     */
    'otp' => [
        'expiry_minutes' => env('OTP_EXPIRY_MINUTES', 10),
        'code_length' => env('OTP_CODE_LENGTH', 6),
    ],
];
