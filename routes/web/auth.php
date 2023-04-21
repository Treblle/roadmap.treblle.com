<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Auth\EmailVerification\VerifyEmailNotificationController;
use App\Http\Controllers\Web\Auth\EmailVerification\VerifyEmailSubmitController;
use App\Http\Controllers\Web\Auth\EmailVerification\VerifyEmailViewController;
use App\Http\Controllers\Web\Auth\ForgotPassword\PasswordResetSubmitController;
use App\Http\Controllers\Web\Auth\ForgotPassword\PasswordResetViewController;
use App\Http\Controllers\Web\Auth\Login\LoginSubmitController;
use App\Http\Controllers\Web\Auth\Login\LoginViewController;
use App\Http\Controllers\Web\Auth\Login\LogoutSubmitController;
use App\Http\Controllers\Web\Auth\Password\UpdatePasswordController;
use App\Http\Controllers\Web\Auth\PasswordConfirmation\ConfirmPasswordSubmitController;
use App\Http\Controllers\Web\Auth\PasswordConfirmation\ConfirmPasswordViewController;
use App\Http\Controllers\Web\Auth\Register\RegistrationSubmitController;
use App\Http\Controllers\Web\Auth\Register\RegistrationViewController;
use App\Http\Controllers\Web\Auth\ResetPassword\PasswordUpdateSubmitController;
use App\Http\Controllers\Web\Auth\ResetPassword\PasswordUpdateViewController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(static function (): void {
    Route::get('register', RegistrationViewController::class)->name('register');
    Route::post('register', RegistrationSubmitController::class)->name('register');

    Route::get('login', LoginViewController::class)->name('login');
    Route::post('login', LoginSubmitController::class)->name('login');

    Route::get('forgot-password', PasswordResetViewController::class)->name('password.request');
    Route::post('forgot-password', PasswordResetSubmitController::class)->name('password.email');

    Route::get('reset-password/{token}', PasswordUpdateViewController::class)->name('password.reset');
    Route::post('reset-password', PasswordUpdateSubmitController::class)->name('password.store');
});

Route::middleware('auth')->group(static function (): void {
    Route::get('verify-email', VerifyEmailViewController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailSubmitController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', VerifyEmailNotificationController::class)->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', ConfirmPasswordViewController::class)->name('password.confirm');
    Route::post('confirm-password', ConfirmPasswordSubmitController::class)->name('password.confirm');

    Route::put('password', UpdatePasswordController::class)->name('password.update');

    Route::post('logout', LogoutSubmitController::class)->name('logout');
});
