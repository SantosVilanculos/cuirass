<?php

declare(strict_types=1);

use App\Livewire\Settings\Photo;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

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

test('profile photo can be deleted', function (): void {
    $user = User::factory()->create();

    Storage::fake('public');

    $image = UploadedFile::fake()->image('avatar.jpg', 200, 200)->size(1024);

    $this->actingAs($user);

    Livewire::test(Photo::class)
        ->set('image', $image)
        ->call('save');

    Storage::disk('public')->assertExists('users/'.$image->hashName());

    Livewire::test(Photo::class)
        ->call('destroy');

    Storage::disk('public')->assertMissing('users/'.$image->hashName());
});
