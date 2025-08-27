<?php

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\json;
use function PHPUnit\Framework\assertJson;

uses(RefreshDatabase::class);

test('user can register successfully', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Tobias',
        'email' => 'tobias@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => 'User created successfully',
        ]);

    expect(User::whereEmail('tobias@example.com')->exists())->toBeTrue();
});


test('registration fails if email already exists', function () {
    User::factory()->create([
        'email' => 'tobias@example.com',
    ]);


    $response = $this->postJson('/api/register', [
        'name' => 'Tobias 2',
        'email' => 'tobias@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('registration_fails_with_invalid_data', function () {
    User::factory()->create([
        'email' => 'tobias@example.com',
    ]);


    $response = $this->postJson('/api/register', [
        'name' => '',
        'email' => 'not_an_email',
        'password' => '123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password', 'name']);
});