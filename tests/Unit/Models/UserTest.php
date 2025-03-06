<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

uses(
    Illuminate\Foundation\Testing\RefreshDatabase::class,
    Tests\TestCase::class
);

beforeEach(fn () => $this->user = User::create(
    [
        'name' => 'John Doe',
        'email' => 'johndoe@example.test',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
    ]
));

test('to array', function (): void {
    expect($this->user->toArray())
        ->toHaveSnakeCaseKeys()
        ->toHaveKeys(
            [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]
        );

    expect(array_diff(array_keys($this->user->toArray()),
        [
            'id',
            'name',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at',
        ]
    ))->toBeEmpty();
});

test('get hidden', fn (): Pest\Expectation => expect($this->user->getHidden())
    ->toEqual(['password', 'remember_token']));

test('get casts', fn (): Pest\Expectation => expect($this->user->getCasts())
    ->toMatchArray(
        [
            'id' => 'int',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ]
    ));

test('create', fn () => $this->assertModelExists($this->user));

describe('unique', function (): void {
    test('email', fn () => User::factory()->create(['email' => 'johndoe@example.test']))
        ->throws(UniqueConstraintViolationException::class);
});

test('find', function (): void {
    $user = User::find($this->user->id);

    $this->assertNotNull($user);

    expect($user->toArray())->toMatchArray($this->user->toArray());
});

test('update', function (): void {
    $this->user->update(
        [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.test',
        ],
    );

    $this->user->refresh();

    expect(Arr::only($this->user->toArray(), ['name', 'email']))
        ->toEqual(
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

test('count', fn (): Pest\Expectation => expect(User::count())->toEqual(1));
