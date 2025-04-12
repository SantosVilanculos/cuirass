<?php

declare(strict_types=1);

use App\Livewire\Settings\Profile;
use App\Models\User;
use Livewire\Livewire;

test('account profile screen can be rendered', function (): void {
    $this->actingAs(User::factory()->create());

    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.account.profile'));

    $response->assertOk();
});

test('user is redirected to login if not authenticated', function (): void {
    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.account.profile'));

    $response->assertRedirect(route('login'));
});

test('profile information can be updated', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->call('save');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
});
