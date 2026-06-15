<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Active SMS Driver
    |--------------------------------------------------------------------------
    | Supported: "smsmisr", "smsala"
    */
    'driver' => env('SMS_OTP_DRIVER', 'smsmisr'),

    /*
    |--------------------------------------------------------------------------
    | SmsMisr Configuration  (https://smsmisr.com)
    |--------------------------------------------------------------------------
    | environment: 1 = Live, 2 = Test
    | In test mode the test_sender token is used automatically.
    */
    'smsmisr' => [
        'environment'    => (int) env('SMSMISR_ENVIRONMENT', 2), // 2 = Test
        'username'       => env('SMSMISR_USERNAME', ''),
        'password'       => env('SMSMISR_PASSWORD', ''),
        'sender'         => env('SMSMISR_SENDER', ''),           // Live sender token
        'test_sender'    => env('SMSMISR_TEST_SENDER', 'b611afb996655a94c8e942a823f1421de42bf8335d24ba1f84c437b2ab11ca27'),
        'template_token' => env('SMSMISR_TEMPLATE_TOKEN', '9b04deada138c009fa6a39ee1ca37c476e1501fbfefb8b72b14a90fe8e863dbe'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SMSala Configuration (legacy / fallback)
    |--------------------------------------------------------------------------
    */
    'smsala' => [
        'api_id'       => env('SMSALA_API_ID', ''),
        'api_password' => env('SMSALA_API_PASSWORD', ''),
        'sender_id'    => env('SMSALA_SENDER_ID', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | OTP Configuration
    |--------------------------------------------------------------------------
    */
    'otp' => [
        'expiry_minutes' => (int) env('OTP_EXPIRY_MINUTES', 10),
        'code_length'    => (int) env('OTP_CODE_LENGTH', 6),
    ],
];
