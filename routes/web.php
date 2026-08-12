<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::welcome')->name('home');

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function (): void {
        Route::livewire('/', 'pages::overview')->name('dashboard');

        Route::livewire('empty-page', 'pages::empty-page')->name('dashboard.empty-page');
    });

Route::middleware(['auth'])->group(function (): void {
    Route::redirect('settings', 'settings/profile');
    Route::livewire('settings/profile', 'pages::profile')->name('settings.profile');
    Route::livewire('settings/security', 'pages::security')->name('settings.security');
});

require __DIR__.'/auth.php';
