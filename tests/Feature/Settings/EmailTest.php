<?php

declare(strict_types=1);

use App\Livewire\Settings\Email;
use App\Models\User;
use Livewire\Livewire;

test('email can be updated', function (): void {
    $user = User::factory()->create();

    $response = Livewire::actingAs($user)
        ->test(Email::class)
        ->set('email', 'test@example.com')
        ->call('save');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->email)->toEqual('test@example.com');
});

test('email verification status is unchanged when email address is unchanged', function (): void {
    $user = User::factory()->create();

    $response = Livewire::actingAs($user)
        ->test(Email::class)
        ->set('email', $user->email)
        ->call('save');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});
