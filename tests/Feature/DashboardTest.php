<?php

declare(strict_types=1);

use App\Models\User;

test('guests are redirected to the login page', function (string $path): void {
    $this->get($path)->assertRedirect('/login');
})->with([
    '/dashboard',
    '/dashboard/empty-page',
]);

test('authenticated users can visit the dashboard', function (string $path): void {
    $this->actingAs($user = User::factory()->create());

    $this->get($path)->assertStatus(200);
})->with([
    '/dashboard',
    '/dashboard/empty-page',
]);
