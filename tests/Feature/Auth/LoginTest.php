<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can log in with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'tobias@example.com'
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'tobias@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)->assertJsonStructure([
        'message',
        'access_token',
        'token_type',
    ]);
});

test('login fails with wrong password', function () {
    $user = User::factory()->create([
        'email' => 'tobias@example.com'
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'tobias@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401)->assertJson([
        'message' => 'Invalid credentials'
    ]);
});

test('login fails if email is not verified', function () {
    $user = User::factory()->unverified()->create([
        'email' => 'tobias@example.com'
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'tobias@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(401)
        ->assertJson([
            'message' => 'Invalid credentials',
        ]);

});
