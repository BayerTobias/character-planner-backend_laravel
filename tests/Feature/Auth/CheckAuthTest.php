<?php

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('authenticated user can access checkAuth', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->getJson('/api/check-auth');


    $response->assertStatus(200)->assertJson([
        'message' => 'Authenticated'
    ]);
});

test('unauthenticated user cannot access checkAuth', function () {
    $response = $this->getJson('/api/check-auth');


    $response->assertStatus(401)->assertJson([
        'message' => 'Unauthenticated.'
    ]);
});
