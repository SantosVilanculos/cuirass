<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

beforeEach(fn () => $this->user = User::create(
    [
        'name' => 'John Doe',
        'email' => 'johndoe@example.test',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
    ]
));

test('create', fn () => $this->assertModelExists($this->user));

test('to array', function (): void {
    $this->user->refresh();

    expect($this->user->toArray())
        ->toHaveSnakeCaseKeys();

    expect(array_keys($this->user->toArray()))
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

test('get hidden', fn (): Pest\Expectation => expect($this->user->getHidden())
    ->toBe(['password', 'remember_token']));

test('get casts', fn (): Pest\Expectation => expect($this->user->getCasts())
    ->toBe(
        [
            'id' => 'int',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ]
    ));

describe('unique', function (): void {
    test('email', fn () => User::factory()->create(['email' => 'johndoe@example.test']))
        ->throws(UniqueConstraintViolationException::class);
});

test('find', function (): void {
    $user = User::find($this->user->id);

    $this->assertNotNull($user);

    expect($user->toArray())->toBe($this->user->fresh()->toArray());
});

test('update', function (): void {
    $this->user->update(
        [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.test',
        ],
    );

    expect(Arr::only($this->user->fresh()->toArray(), ['name', 'email']))
        ->toBe(
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.test',
            ],
        );
});

test('delete', function (): void {
    $this->user->delete();

    $this->assertModelMissing($this->user);
});

test('count', fn (): Pest\Expectation => expect(User::count())->toBe(1));
