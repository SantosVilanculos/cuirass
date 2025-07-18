<?php

declare(strict_types=1);
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Hash;

test('to array', function (): void {
    $user = User::factory()->create();

    $user->refresh();

    expect($user->toArray())->toHaveSnakeCaseKeys();

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

    expect($user->getHidden())->toBe(['password', 'remember_token']);

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

    // id
    expect($user->id)->toBeInt();

    // email_verified_at
    expect($user->email_verified_at)->toBeInstanceOf(CarbonImmutable::class);

    // password
    expect(Hash::isHashed($user->password))->toBeTrue();
    expect(Hash::check('password', $user->password))->toBeTrue();
});

describe('email', function (): void {
    beforeEach(fn () => User::factory()->create(['email' => 'johndoe@example.test']));

    test('throws unique constraint violation exception', fn () => User::factory()->create(['email' => 'johndoe@example.test']))
        ->throws(UniqueConstraintViolationException::class);

    test('throws no exceptions', fn () => User::factory()->create(['email' => 'janedoe@example.test']))
        ->throwsNoExceptions();
});
