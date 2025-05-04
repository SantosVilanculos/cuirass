<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

test('create', function (): void {
    $now = $this->freezeTime()->format('Y-m-d H:i:s');

    $user = User::factory()->create();

    $this->assertModelExists($user);

    $user->refresh();

    expect($user->created_at->format('Y-m-d H:i:s'))->toBe($now);
    expect($user->updated_at->format('Y-m-d H:i:s'))->toBe($now);
});

test('read', function (): void {
    $user = User::factory()->create();

    $model = User::find($user->id);

    $this->assertNotNull($model);

    expect($user->fresh()->toArray())->toBe($model->toArray());
});

test('update', function (): void {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@example.test',
    ]);

    $this->travelTo($now = now()->addDay()->format('Y-m-d H:i:s'));

    $user->update(
        [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.test',
        ],
    );

    $user->refresh();

    expect(Arr::only($user->toArray(), ['name', 'email']))
        ->toBe(
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.test',
            ],
        );

    expect($user->updated_at->format('Y-m-d H:i:s'))->toBe($now);
});

test('delete', function (): void {
    $user = User::factory()->create();

    $user->delete();

    $this->assertModelMissing($user);
});

test('to array', function (): void {
    $user = User::factory()->create();

    $user->refresh();

    expect($user->toArray())
        ->toHaveSnakeCaseKeys();

    expect(array_keys($user->toArray()))
        ->toBe(
            [
                'id',
                'image',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]
        );
});

test('get hidden', function (): void {
    $user = User::factory()->create();

    expect($user->getHidden())
        ->toBe(['password', 'remember_token']);

    expect($user->toArray())->not->toHaveKeys(['password', 'remember_token']);
});

test('get casts', function (): void {
    $user = User::factory()->create(['password' => 'password']);

    expect($user->getCasts())
        ->toBe(
            [
                'id' => 'int',
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
            ]
        );

    // email_verified_at
    $this->assertInstanceOf(Carbon\CarbonImmutable::class, $user->email_verified_at);

    // password
    $this->assertTrue(Hash::isHashed($user->password));
    $this->assertTrue(Hash::check('password', $user->password));
});

test('email', function (): void {
    User::factory()->create(['email' => 'johndoe@example.test']);

    User::factory()->create(['email' => 'johndoe@example.test']);
})->throws(UniqueConstraintViolationException::class);
