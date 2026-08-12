<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::livewire('/login', 'pages::login')->name('login');
    Route::livewire('/register', 'pages::register')->name('register');
    Route::livewire('/forgot-password', 'pages::forgot-password')->name('password.request');
    Route::livewire('/reset-password/{token}', 'pages::reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function (): void {
    Route::livewire('/verify-email', 'pages::verify-email')->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::livewire('/confirm-password', 'pages::confirm-password')->name('password.confirm');
});
