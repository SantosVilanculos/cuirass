<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn (): Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View => view('pages.welcome'))->name('home');

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function (): void {
        Route::view('/', 'pages.overview')->name('dashboard');

        Route::view('empty-page', 'pages.empty-page')->name('dashboard.empty-page');
    });

Route::middleware(['auth'])->group(function (): void {
    Route::redirect('settings', 'settings/profile');
    Route::view('settings/profile', 'pages.profile')->name('settings.profile');
    Route::view('settings/security', 'pages.security')->name('settings.security');
});

require __DIR__.'/auth.php';
