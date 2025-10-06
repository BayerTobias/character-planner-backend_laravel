<?php

use App\Models\characters\CharacterClass;
use App\Models\skills\BasicSkill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('returns a list of character classes with skills', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $class = CharacterClass::factory()->create();

    BasicSkill::factory()->count(3)->create([
        'character_class_id' => $class->id
    ]);

    $response = $this->getJson("/api/classes/{$class->id}");

    $response->assertStatus(200)
        ->assertJson(
            [
                'id' => $class->id,
                'name' => $class->name
            ]
        )
        ->assertJsonCount(3, 'basic_skills');
});

test('unauthenticated user cannot access character classes with skills', function () {
    CharacterClass::factory()->count(5)->create();

    $response = $this->getJson('/api/classes/1');

    $response->assertStatus(401);
});

test('returns 404 if class not found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $response = $this->getJson('/api/classes/999');

    $response->assertStatus(404)
        ->assertJson(['message' => 'Class not found']);
});


