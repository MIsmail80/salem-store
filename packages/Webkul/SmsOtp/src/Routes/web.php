<?php

use Illuminate\Support\Facades\Route;
use Webkul\SmsOtp\Http\Controllers\OtpController;

Route::group(['prefix' => 'api/otp'], function () {
    Route::post('send', [OtpController::class, 'send'])->name('smsotp.send');
    Route::post('verify', [OtpController::class, 'verify'])->name('smsotp.verify');
});
