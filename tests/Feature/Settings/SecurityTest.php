<?php

declare(strict_types=1);

use App\Livewire\Settings\DeleteUserModal;
use App\Livewire\Settings\PasswordModal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('security screen can be rendered', function (): void {
    $this->actingAs(User::factory()->create());

    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.security'));

    $response->assertOk();
});

test('user is redirected to login if not authenticated', function (): void {
    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.security'));

    $response->assertRedirect(route('login'));
});

describe('password', function (): void {

    test('password can be updated', function (): void {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);

        $response = Livewire::test(PasswordModal::class)
            ->set('current_password', 'password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('save');

        $response->assertHasNoErrors();

        expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
    });

    test('correct password must be provided to update password', function (): void {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);

        $response = Livewire::test(PasswordModal::class)
            ->set('current_password', 'wrong-password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('save');

        $response->assertHasErrors(['current_password']);
    });
});

describe('delete user', function (): void {

    test('user can delete their account', function (): void {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(DeleteUserModal::class)
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

        $response = Livewire::test(DeleteUserModal::class)
            ->set('password', 'wrong-password')
            ->call('destroy1');

        $response
            ->assertHasErrors(['password'])
            ->assertNoRedirect();

        expect($user->fresh())->not->toBeNull();
        expect(auth()->check())->toBeTrue();
    });
});
