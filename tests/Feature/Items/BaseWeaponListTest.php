<?php

use App\Models\Items\BaseWeapon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('returns a list of base weapons', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    BaseWeapon::factory()->count(5)->create();

    $respone = $this->getJson('/api/base-weapons');

    $respone->assertStatus(200)
        ->assertJsonCount(5);
});

test('unauthenticated user cannot access base weapons list', function () {
    BaseWeapon::factory()->count(5)->create();

    $response = $this->getJson('/api/base-weapons');

    $response->assertStatus(401);
});
