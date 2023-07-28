<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
], function () {
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/store', [AuthenticationController::class, 'store'])->name('store');
    Route::get('/notification-register', [AuthenticationController::class, 'notificationRegister'])->name('notification-register');

    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/sign-in', [AuthenticationController::class, 'signIn'])->name('sign-in');

    Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/send-otp', [AuthenticationController::class, 'sendOtp'])->name('send-otp');
    Route::post('/show-form-verify-otp', [AuthenticationController::class, 'showFormVerifyOtp'])->name('show-form-verify-otp');
    Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtp'])->name('verify-otp');
    Route::post('/show-form-reset-password', [AuthenticationController::class, 'showFormResetPassword'])->name('show-form-reset-password');
    Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');
});
