<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

test('example', function () {
    actingAs(User::factory()->create())->get('/')->assertStatus(200);
});
