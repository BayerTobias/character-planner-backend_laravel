<?php

use App\Models\characters\CharacterRace;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('returns a list of character races', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    CharacterRace::factory()->count(5)->create();

    $response = $this->getJson('/api/races');

    $response->assertStatus(200)
        ->assertJsonCount(5);
});

test('unauthenticated user cannot access character race list', function () {
    CharacterRace::factory()->count(5)->create();

    $response = $this->getJson('/api/classes');

    $response->assertStatus(401);
});
