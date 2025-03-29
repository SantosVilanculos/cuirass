<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.welcome'))->name('home');

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function (): void {
        Route::view('/', 'pages.dashboard.overview')->name('dashboard');

        Route::view('empty-page', 'pages.dashboard.empty-page')->name('dashboard.empty-page');
    });

Route::middleware(['auth'])->group(function (): void {
    Route::redirect('settings', 'settings/account');

    Route::view('settings/account', 'pages.settings.account')->name('settings.account');
    Route::view('settings/account/profile', 'pages.settings.account-profile')->name('settings.account.profile');
    Route::view('settings/account/photo', 'pages.settings.account-photo')->name('settings.account.photo');
});

require __DIR__.'/auth.php';
