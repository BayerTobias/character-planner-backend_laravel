<?php

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

test('sends password reset email if user exists', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->postJson('/api/forgot-password', [
        'email' => $user->email,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'If your email exists, you will receive a reset link.'
        ]);

    Notification::assertSentTo(
        [$user],
        ResetPasswordNotification::class,
        function ($notification, $channels) {
            return !empty($notification->token);
        }
    );
});

test('returns error if email is invalid', function () {
    $response = $this->postJson('/api/forgot-password', [
        'email' => 'not-an-email',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('email');
});

test('returns success even if user does not exist', function () {
    $response = $this->postJson('/api/forgot-password', [
        'email' => 'nonexistent@example.com',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'If your email exists, you will receive a reset link.'
        ]);
});


