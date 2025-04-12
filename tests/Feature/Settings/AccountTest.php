<?php

declare(strict_types=1);

use App\Livewire\Settings\Delete;
use App\Livewire\Settings\Email;
use App\Livewire\Settings\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('account settings screen can be rendered', function (): void {
    $this->actingAs(User::factory()->create());

    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.account'));

    $response->assertOk();
});

test('user is redirected to login if not authenticated', function (): void {
    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.account'));

    $response->assertRedirect(route('login'));
});

describe('email', function () {
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
});

describe('password', function () {

    test('password can be updated', function (): void {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);

        $response = Livewire::test(Password::class)
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

        $response = Livewire::test(Password::class)
            ->set('current_password', 'wrong-password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('save');

        $response->assertHasErrors(['current_password']);
    });
});

describe('delete', function () {

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
});
