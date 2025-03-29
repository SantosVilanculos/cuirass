<?php

declare(strict_types=1);

use App\Livewire\Settings\Delete;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('user can delete their account', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Delete::class)
        ->set('password', 'password')
        ->call('destroy1');

    $response
        ->assertHasNoErrors()
        ->assertRedirectToRoute('login');

    expect($user->fresh())->toBeNull();
    expect(auth()->check())->toBeFalse();
});

test('correct password must be provided to delete account', function (): void {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Delete::class)
        ->set('password', 'wrong-password')
        ->call('destroy1');

    $response
        ->assertHasErrors(['password'])
        ->assertNoRedirect();

    expect($user->fresh())->not->toBeNull();
    expect(auth()->check())->toBeTrue();
});
