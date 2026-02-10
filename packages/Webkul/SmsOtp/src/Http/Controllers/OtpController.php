<?php

namespace Webkul\SmsOtp\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Webkul\SmsOtp\Models\Otp;
use Webkul\SmsOtp\Services\SmsalaService;

class OtpController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected SmsalaService $smsService
    ) {
    }

    /**
     * Send OTP to the given phone number.
     */
    public function send(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $phone = $request->input('phone');

        // Rate limiting: Check if OTP was sent recently
        $recentOtp = Otp::where('phone', $phone)
            ->where('created_at', '>', now()->subMinutes(1))
            ->first();

        if ($recentOtp) {
            return response()->json([
                'success' => false,
                'message' => trans('smsotp::app.rate-limit'),
            ], 429);
        }

        // Create new OTP
        $otp = Otp::createForPhone($phone);

        // Send via SMS
        $result = $this->smsService->sendOtp($phone, $otp->code);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => trans('smsotp::app.otp-sent'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('smsotp::app.otp-failed'),
        ], 500);
    }

    /**
     * Verify the OTP for the given phone number.
     */
    public function verify(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:20',
            'code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $phone = $request->input('phone');
        $code = $request->input('code');

        $otp = Otp::verify($phone, $code);

        if ($otp) {
            return response()->json([
                'success' => true,
                'message' => trans('smsotp::app.otp-verified'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('smsotp::app.otp-invalid'),
        ], 422);
    }
}
