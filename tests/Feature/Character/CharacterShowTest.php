<?php

use App\Models\characters\Character;
use App\Models\characters\CharacterClass;
use App\Models\characters\CharacterRace;
use App\Models\characters\Money;
use App\Models\Items\BaseArmor;
use App\Models\Items\BaseWeapon;
use App\Models\Items\WeaponGroup;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

test('returns a single character for authenticated user', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $character = Character::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->getJson("/api/characters/{$character->id}");

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

test('returns 404 if character not found', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $response = $this->getJson("/api/characters/{1}");

    $response->assertStatus(404)
        ->assertJson(['message' => 'Character nor found or nor authorized']);
});

test('unauthenticated user cannot access character', function () {
    $user = User::factory()->create();

    $character = Character::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->getJson("/api/characters/{$character->id}");

    $response->assertStatus(401);
});

test('character includes related models', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $baseArmor = BaseArmor::factory()->armor()->create();
    $shield = BaseArmor::factory()->shield()->create();
    $baseWeapons = BaseWeapon::factory()->withWeaponGroups(2)->count(2)->create();
    $class = CharacterClass::factory()->withSkills()->create();
    $race = CharacterRace::factory()->create();

    $character = Character::factory()->withMana()->withMoney()->create([
        'user_id' => $user->id,
        'base_armor_id' => $baseArmor->id,
        'shield_id' => $shield->id,
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,
    ]);

    $character->baseWeapons()->attach($baseWeapons->pluck('id'));

    $response = getJson("/api/characters/{$character->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name',
            'max_hp',
            'current_hp',
            'max_mana',
            'current_mana',
            'character_race' => [
                'id',
                'name',
                'strength_modifier',
                'agility_modifier',
                'constitution_modifier',
                'intelligence_modifier',
                'charisma_modifier',
            ],
            'character_class' => [
                'id',
                'name',
                'base_lvl_hp',
                'base_lvl_mana',
                'main_stat',
                'color',
                'basic_skills' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'first_level_cost',
                        'second_level_cost',
                    ],
                ],
            ],
            'base_armor' => [
                'id',
                'name',
                'min_str',
                'armor_bonus',
                'maneuver_bonus',
                'weight',
                'type',
            ],
            'shield' => [
                'id',
                'name',
                'min_str',
                'armor_bonus',
                'maneuver_bonus',
                'weight',
                'type',
            ],
            'base_weapons' => [
                '*' => [
                    'id',
                    'name',
                    'min_str',
                    'dmg',
                    'attribute',
                    'weight',
                    'ini_bonus',
                    'weapon_group' => [
                        '*' => [
                            'id',
                            'name',
                        ],
                    ],
                ],
            ],
            'custom_weapons',
            'money' => [
                'id',
                'gf',
                'tt',
                'kl',
                'mu',
            ],
            'skilled_skills',
            'strength_value',
            'strength_bonus',
            'agility_value',
            'agility_bonus',
            'constitution_value',
            'constitution_bonus',
            'intelligence_value',
            'intelligence_bonus',
            'charisma_value',
            'charisma_bonus',
            'user_id',
            'current_lvl',
            'attribute_points',
        ]);
});

