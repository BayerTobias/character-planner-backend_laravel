<?php

use App\Models\Items\WeaponGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

test('returns a list of weapon groups', function () {
    $user = User::factory()->create();
    actingAs($user, 'sanctum');

    WeaponGroup::factory()->count(5)->create();

    $response = getJson('/api/weapon-groups');

    $response->assertStatus(200)
        ->assertJsonCount(5);
});

test('unauthenticated user cannot access weapon group list', function () {
    WeaponGroup::factory()->count(5)->create();

    $response = $this->getJson('/api/weapon-groups');

    $response->assertStatus(401);
});
