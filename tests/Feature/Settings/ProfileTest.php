<?php

declare(strict_types=1);

use App\Livewire\Settings\EmailForm;
use App\Livewire\Settings\ImageForm;
use App\Livewire\Settings\NameForm;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

test('profile screen can be rendered', function (): void {
    $this->actingAs(User::factory()->create());

    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.profile'));

    $response->assertOk();
});

test('user is redirected to login if not authenticated', function (): void {
    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get(route('settings.profile'));

    $response->assertRedirect(route('login'));
});

// image

describe('image', function (): void {
    test('image can be uploaded', function (): void {
        $user = User::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('avatar.jpg', 256, 256)->size(1024);

        $this->actingAs($user);

        $response = Livewire::test(ImageForm::class)
            ->set('image', $image);

        $response->assertHasNoErrors();

        $user->refresh();

        Storage::disk('public')->assertExists('users/'.$image->hashName());
    });

    test('only images less than 2MB can be uploaded', function (): void {
        $user = User::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('avatar.jpg', 256, 256)->size(4096);

        $this->actingAs($user);

        $response = Livewire::test(ImageForm::class)
            ->set('image', $image);

        $response->assertHasErrors();

        $user->refresh();

        Storage::disk('public')->assertMissing('users/'.$image->hashName());
    });

    test('only images 192x192 or more can be uploaded', function (): void {
        $user = User::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('avatar.jpg', 128, 128)->size(1024);

        $this->actingAs($user);

        $response = Livewire::test(ImageForm::class)
            ->set('image', $image);

        $response->assertHasErrors();

        $user->refresh();

        Storage::disk('public')->assertMissing('users/'.$image->hashName());
    });

    test('image can be deleted', function (): void {

        Storage::fake('public');

        $path = UploadedFile::fake()
            ->image('avatar.jpg', 256, 256)
            ->size(1024)
            ->store('users', ['disk' => 'public']);

        $user = User::factory()->create(['image' => $path]);

        $this->actingAs($user);

        Livewire::test(ImageForm::class)
            ->call('destroy');

        Storage::disk('public')->assertMissing($path);
    });
});

describe('name', function (): void {
    test('user name can be updated', function (): void {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test(NameForm::class)
            ->set('name', 'Test User')
            ->call('save');

        $response->assertHasNoErrors();

        $user->refresh();

        expect($user->name)->toEqual('Test User');
    });
});

describe('email', function (): void {
    test('email can be updated', function (): void {
        $user = User::factory()->create();

        $response = Livewire::actingAs($user)
            ->test(EmailForm::class)
            ->set('email', 'test@example.com')
            ->call('save');

        $response->assertHasNoErrors();

        $user->refresh();

        expect($user->email)->toEqual('test@example.com');
    });

    test('email verification status is unchanged when email address is unchanged', function (): void {
        $user = User::factory()->create();

        $response = Livewire::actingAs($user)
            ->test(EmailForm::class)
            ->set('email', $user->email)
            ->call('save');

        $response->assertHasNoErrors();

        expect($user->refresh()->email_verified_at)->not->toBeNull();
    });
});
