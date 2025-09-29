<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

uses(RefreshDatabase::class);

test('can reset password with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();
    $token = Password::createToken($user);

    $response = $this->postJson('/api/reset-password', [
        'email' => $user->email,
        'password' => 'newpassword',
        'password_confirmation' => 'newpassword',
        'token' => $token,
    ]);

    $response->assertStatus(200)
        ->assertJson(['message' => 'Password successfully reset.']);

    $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
});

test('cannot reset password with invalid token', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/reset-password', [
        'email' => $user->email,
        'password' => 'newpassword',
        'password_confirmation' => 'newpassword',
        'token' => 'invalid-token',
    ]);

    $response->assertStatus(400)
        ->assertJson(['message' => __('passwords.token')]);
});

test('requires email, password and token', function () {
    $response = $this->postJson('/api/reset-password', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password', 'token']);
});