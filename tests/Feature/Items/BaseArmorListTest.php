<?php

use App\Models\Items\BaseArmor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('returns a list of base armors', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    BaseArmor::factory()->count(5)->create();

    $respone = $this->getJson('/api/base-armors');

    $respone->assertStatus(200)
        ->assertJsonCount(5);
});

test('unauthenticated user cannot access base armor list', function () {
    BaseArmor::factory()->count(5)->create();

    $response = $this->getJson('/api/base-armors');

    $response->assertStatus(401);
});
