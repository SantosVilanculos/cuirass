<?php

declare(strict_types=1);

use App\Livewire\Settings\Photo;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

test('account photo screen can be rendered', function (): void {
    $this->actingAs(User::factory()->create());

    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.account.photo'));

    $response->assertOk();
});

test('user is redirected to login if not authenticated', function (): void {
    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.account.photo'));

    $response->assertRedirect(route('login'));
});
test('profile photo can be uploaded', function (): void {
    $user = User::factory()->create();

    Storage::fake('public');

    $image = UploadedFile::fake()->image('avatar.jpg', 256, 256)->size(1024);

    $this->actingAs($user);

    $response = Livewire::test(Photo::class)
        ->set('image', $image);

    $response->assertHasNoErrors();

    $user->refresh();

    Storage::disk('public')->assertExists('users/'.$image->hashName());
});

test('only profile photos less than 2MB can be uploaded', function (): void {
    $user = User::factory()->create();

    Storage::fake('public');

    $image = UploadedFile::fake()->image('avatar.jpg', 256, 256)->size(4096);

    $this->actingAs($user);

    $response = Livewire::test(Photo::class)
        ->set('image', $image);

    $response->assertHasErrors();

    $user->refresh();

    Storage::disk('public')->assertMissing('users/'.$image->hashName());
});

test('only profile photos 192x192 or more can be uploaded', function (): void {
    $user = User::factory()->create();

    Storage::fake('public');

    $image = UploadedFile::fake()->image('avatar.jpg', 128, 128)->size(1024);

    $this->actingAs($user);

    $response = Livewire::test(Photo::class)
        ->set('image', $image);

    $response->assertHasErrors();

    $user->refresh();

    Storage::disk('public')->assertMissing('users/'.$image->hashName());
});

test('profile photo can be deleted', function (): void {

    Storage::fake('public');

    $path = UploadedFile::fake()
        ->image('avatar.jpg', 256, 256)
        ->size(1024)
        ->store('users', ['disk' => 'public']);

    $user = User::factory()->create(['image' => $path]);

    $this->actingAs($user);

    Livewire::test(Photo::class)
        ->call('destroy');

    Storage::disk('public')->assertMissing($path);
});
