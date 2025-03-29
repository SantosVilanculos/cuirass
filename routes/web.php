<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.welcome'))->name('home');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::view('dashboard', 'pages.dashboard')->name('dashboard');
    Route::view('empty-page', 'pages.empty-page')->name('empty-page');
});

Route::middleware(['auth'])->group(function (): void {
    Route::redirect('settings', 'settings/profile');

    Route::view('settings/profile', 'pages.settings.profile')->name('settings.profile');
});

require __DIR__.'/auth.php';
