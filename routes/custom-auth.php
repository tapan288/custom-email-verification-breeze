<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomUser\Auth\RegisteredUserController;
use App\Http\Controllers\CustomUser\Auth\EmailVerificationPromptController;

Route::get('custom-user/dashboard', function () {
    return view('custom-auth.dashboard');
})->middleware([
            'customUserAuth',
            'ensureEmailIsVerified:customUserAuth,custom-user.verification.notice'
        ])->name('custom-user.dashboard');

Route::group([
    'middleware' => ['guest:customUserAuth'],
    'as' => 'custom-user.',
    'prefix' => 'custom-user',
], function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    // Route::get('login', [AuthenticatedSessionController::class, 'create'])
    //             ->name('login');

    // Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //             ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //             ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //             ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //             ->name('password.store');
});

Route::group([
    'middleware' => ['guest:customUserAuth'],
    'as' => 'custom-user.',
    'prefix' => 'custom-user',
], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //             ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    //             ->name('logout');
});
