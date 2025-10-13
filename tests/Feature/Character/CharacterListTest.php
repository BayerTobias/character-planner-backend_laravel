<?php

use App\Models\characters\Character;
use App\Models\characters\CharacterClass;
use App\Models\characters\CharacterRace;
use App\Models\Items\BaseArmor;
use App\Models\Items\BaseWeapon;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('returns all characters for authenticated user', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $class = CharacterClass::factory()->withSkills()->create();
    $race = CharacterRace::factory()->create();

    Character::factory()->count(3)->create([
        'user_id' => $user->id,
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,
    ]);

    $response = $this->getJson("/api/characters");

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

test('returns empty list if user has no characters', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $response = $this->getJson("/api/characters");

    $response->assertStatus(200)
        ->assertExactJson([]);
});

test('does not return characters of other users', function () {
    $user_1 = User::factory()->create();
    $user_2 = User::factory()->create();
    actingAs($user_1, 'sanctum');

    $class = CharacterClass::factory()->withSkills()->create();
    $race = CharacterRace::factory()->create();

    $user_1_characters = Character::factory()->count(3)->create([
        'user_id' => $user_1->id,
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,
    ]);

    $user_2_characters = Character::factory()->count(2)->create([
        'user_id' => $user_2->id,
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,
    ]);

    $response = $this->getJson("/api/characters");

    $expectedIds = $user_1_characters->pluck('id')->sort()->values()->all();
    $returnedIds = collect($response->json())->pluck('id')->sort()->values()->all();

    $response->assertStatus(200)
        ->assertJsonCount(3);

    expect($returnedIds)->toEqual($expectedIds);
});

test('unauthenticated user cannot access character list', function () {
    $user = User::factory()->create();

    $character = Character::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->getJson("/api/characters");

    $response->assertStatus(401);

});

