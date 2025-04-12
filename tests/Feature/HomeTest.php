<?php

declare(strict_types=1);

test('returns a successful response', function (): void {
    /** @var Illuminate\Testing\TestResponse */
    $response = $this->get('/');

    $response->assertStatus(200);
});
