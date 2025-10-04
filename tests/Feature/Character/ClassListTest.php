<?php

use App\Models\characters\CharacterClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('returns a list of character classes', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    CharacterClass::factory()->count(5)->create();

    $response = $this->getJson('/api/classes');

    $response->assertStatus(200)
        ->assertJsonCount(5);
});

test('unauthenticated user cannot access character class list', function () {
    CharacterClass::factory()->count(5)->create();

    $response = $this->getJson('/api/classes');

    $response->assertStatus(401);
});
