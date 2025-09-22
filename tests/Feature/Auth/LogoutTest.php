<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can logout and token is deleted', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test_token')->plainTextToken;

    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_id' => $user->id,
        'tokenable_type' => User::class,
        'name' => 'test_token',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson('/api/logout');

    $response->assertStatus(200)->assertJson([
        'message' => 'Successfully logged out'
    ]);

    $this->assertDatabaseMissing('personal_access_tokens', [
        'tokenable_id' => $user->id,
        'tokenable_type' => User::class,
    ]);
});

test('unauthenticated user cannot access logout', function () {
    $response = $this->postJson('/api/logout');

    $response->assertStatus(401)->assertJson([
        'message' => 'Unauthenticated.'
    ]);
});
