<?php

declare(strict_types=1);

use App\Models\User;

test('guests are redirected to the login page', function (string $path): void {
    $this->get($path)->assertRedirect('/login');
})->with([
    '/dashboard',
    '/dashboard/empty-page',
]);

test('authenticated users can visit the dashboard', function (string $path, string $title): void {
    $this->actingAs($user = User::factory()->create());

    $this->get($path)
        ->assertStatus(200)
        ->assertSee('<h2 class="page-title">'.$title.'</h2>', false);
})->with([
    ['/dashboard', 'Overview'],
    ['/dashboard/empty-page', 'Empty page'],
]);
