<?php

use App\Models\characters\Character;
use App\Models\characters\CharacterClass;
use App\Models\characters\CharacterRace;
use App\Models\Items\BaseWeapon;
use App\Models\Items\WeaponGroup;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('returns a single character for authenticated user', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $character = Character::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->get("/api/characters/{$user->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name',
            'max_hp',
            'current_hp',
            'max_mana',
            'current_mana',
            'character_race',
            'character_class',
            'base_armor',
            'shield',
            'base_weapons',
            'custom_weapons',
            'money',
            'skilled_skills',
            "strength_value",
            "strength_bonus",
            "agility_value",
            "agility_bonus",
            "constitution_value",
            "constitution_bonus",
            "intelligence_value",
            "intelligence_bonus",
            "charisma_value",
            "charisma_bonus",
            "user_id",
            "current_lvl",
            "attribute_points",
        ]);
});
