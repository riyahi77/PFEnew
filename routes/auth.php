<?php
use App\Http\Controllers\StaticController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\PdfController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
   Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
 Route::get('test', [StaticController::class, 'test'])
                ->name('test');
 Route::get('test1', [StaticController::class, 'test1'])
                ->name('test1');
 Route::get('formpdf', [StaticController::class, 'formpdf'])
                ->name('formpdf');
  Route::get('fin', [PdfController::class, 'fin'])
                ->name('fin');         

  Route::get('pdf', [PdfController::class, 'pdf'])
                ->name('pdf');
   Route::get('register2', [StaticController::class, 'register2'])
                ->name('register2');


Route::get('test2', [StaticController::class, 'test2'])
                ->name('test2');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('fin', [PdfController::class, 'fin'])
    ->name('fin');         

Route::get('pdf', [PdfController::class, 'pdf'])
    ->name('pdf');
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
