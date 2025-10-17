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

test('creates a new character successfully', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $armor = BaseArmor::factory()->armor()->create();
    $shield = BaseArmor::factory()->shield()->create();
    $baseWeapons = BaseWeapon::factory()->withWeaponGroups(2)->count(2)->create();
    $class = CharacterClass::factory()->withSkills()->create();
    $race = CharacterRace::factory()->create();

    $skills = $class->basicSkills;

    $payload = [
        'name' => 'Test Character',
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,

        'max_hp' => 100,
        'current_hp' => 80,
        'max_mana' => 50,
        'current_mana' => 50,

        'strength_value' => 10,
        'strength_bonus' => 1,
        'agility_value' => 12,
        'agility_bonus' => 2,
        'constitution_value' => 11,
        'constitution_bonus' => 0,
        'intelligence_value' => 9,
        'intelligence_bonus' => -1,
        'charisma_value' => 8,
        'charisma_bonus' => 0,

        'base_armor_id' => $armor->id,
        'shield_id' => $shield->id,

        'current_lvl' => 1,
        'attribute_points' => 5,

        'money' => [
            'gf' => 10,
            'kl' => 5,
            'mu' => 3,
            'tt' => 1,
        ],

        'skilled_skills' => $skills->map(fn($s) => [
            'skill_id' => $s->id,
            'nodes_skilled' => 2,
        ])->toArray(),

        'base_weapons' => $baseWeapons->pluck('id')->toArray(),

        'custom_weapons' => [
            [
                'name' => 'Custom Sword',
                'weapon_group' => ['1', '2'],
                'min_str' => 8,
                'dmg' => 5,
                'attribute' => 'STR',
                'weight' => 4.5,
                'ini_bonus' => 1,
                'special' => 'Flaming blade',
            ]
        ]
    ];


    $response = $this->postJson('/api/characters', $payload);

    $response->assertStatus(201)
        ->assertJsonPath('name', 'Test Character')
        ->assertJsonPath('money.gf', 10);

    $this->assertDatabaseHas('characters', [
        'name' => 'Test Character',
        'user_id' => $user->id,
    ]);

    $this->assertDatabaseHas('money', [
        'character_id' => $response->json('id'),
        'gf' => 10,
        'kl' => 5,
        'mu' => 3,
        'tt' => 1,
    ]);
});

test('updates existing character successfully', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $armor = BaseArmor::factory()->armor()->create();
    $shield = BaseArmor::factory()->shield()->create();
    $baseWeapons = BaseWeapon::factory()->withWeaponGroups(2)->count(2)->create();
    $class = CharacterClass::factory()->withSkills()->create();
    $race = CharacterRace::factory()->create();

    $character = Character::factory()->withMana()->withMoney()->create([
        'user_id' => $user->id,
        'base_armor_id' => $race->id,
        'shield_id' => $shield->id,
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,
    ]);

    $character->baseWeapons()->attach($baseWeapons->pluck('id'));

    $skills = $class->basicSkills;

    $payload = [
        'id' => $character->id,
        'name' => 'Updated Character',
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,

        'max_hp' => 100,
        'current_hp' => 80,
        'max_mana' => 50,
        'current_mana' => 50,

        'strength_value' => 10,
        'strength_bonus' => 1,
        'agility_value' => 12,
        'agility_bonus' => 2,
        'constitution_value' => 11,
        'constitution_bonus' => 0,
        'intelligence_value' => 9,
        'intelligence_bonus' => -1,
        'charisma_value' => 8,
        'charisma_bonus' => 0,

        'base_armor_id' => null,
        'shield_id' => null,

        'current_lvl' => 1,
        'attribute_points' => 5,

        'money' => [
            'gf' => 10,
            'kl' => 5,
            'mu' => 3,
            'tt' => 1,
        ],

        'skilled_skills' => $skills->map(fn($s) => [
            'skill_id' => $s->id,
            'nodes_skilled' => 2,
        ])->toArray(),

        'base_weapons' => $baseWeapons->pluck('id')->toArray(),

        'custom_weapons' => [
            [
                'name' => 'Custom Sword',
                'weapon_group' => ['1', '2'],
                'min_str' => 8,
                'dmg' => 5,
                'attribute' => 'STR',
                'weight' => 4.5,
                'ini_bonus' => 1,
                'special' => 'Flaming blade',
            ]
        ]
    ];

    $response = $this->postJson('/api/characters', $payload);

    $response->assertStatus(200)
        ->assertJsonPath('name', 'Updated Character')
        ->assertJsonPath('base_armor_id', null)
        ->assertJsonPath('shield_id', null);

    $this->assertDatabaseHas('characters', [
        'name' => 'Updated Character',
        'user_id' => $user->id,
        'id' => $character->id
    ]);
});

test('returns validation errors for invalid data', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    $payload = [
        'name' => '',
        'character_race_id' => null,
        'character_class_id' => 'abc',
    ];

    $response = $this->postJson('/api/characters', $payload);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors([
        'name',
        'character_race_id',
        'character_class_id',
        'money.gf',
        'money.tt',
    ]);
});

test('unauthenticated user cannot create or update character', function () {
    $user = User::factory()->create();

    $armor = BaseArmor::factory()->armor()->create();
    $shield = BaseArmor::factory()->shield()->create();
    $baseWeapons = BaseWeapon::factory()->withWeaponGroups(2)->count(2)->create();
    $class = CharacterClass::factory()->withSkills()->create();
    $race = CharacterRace::factory()->create();

    $skills = $class->basicSkills;

    $payload = [
        'name' => 'Test Character',
        'character_race_id' => $race->id,
        'character_class_id' => $class->id,

        'max_hp' => 100,
        'current_hp' => 80,
        'max_mana' => 50,
        'current_mana' => 50,

        'strength_value' => 10,
        'strength_bonus' => 1,
        'agility_value' => 12,
        'agility_bonus' => 2,
        'constitution_value' => 11,
        'constitution_bonus' => 0,
        'intelligence_value' => 9,
        'intelligence_bonus' => -1,
        'charisma_value' => 8,
        'charisma_bonus' => 0,

        'base_armor_id' => $armor->id,
        'shield_id' => $shield->id,

        'current_lvl' => 1,
        'attribute_points' => 5,

        'money' => [
            'gf' => 10,
            'kl' => 5,
            'mu' => 3,
            'tt' => 1,
        ],

        'skilled_skills' => $skills->map(fn($s) => [
            'skill_id' => $s->id,
            'nodes_skilled' => 2,
        ])->toArray(),

        'base_weapons' => $baseWeapons->pluck('id')->toArray(),

        'custom_weapons' => [
            [
                'name' => 'Custom Sword',
                'weapon_group' => ['1', '2'],
                'min_str' => 8,
                'dmg' => 5,
                'attribute' => 'STR',
                'weight' => 4.5,
                'ini_bonus' => 1,
                'special' => 'Flaming blade',
            ]
        ]
    ];

    $response = $this->postJson('/api/characters', $payload);

    $response->assertStatus(401);
});
