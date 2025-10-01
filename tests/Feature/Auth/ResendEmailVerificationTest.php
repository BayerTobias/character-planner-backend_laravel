<?php

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

test('resends verification email if user exists and is not verified', function () {
    Notification::fake();

    $user = User::factory()->create(
        ['email_verified_at' => null]
    );

    $response = $this->postJson('/api/resend-verification', [
        'email' => $user->email
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Verification email sent'
        ]);

    Notification::assertSentTo($user, VerifyEmailNotification::class);
});


test('returns already verified if user has verified email', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->postJson('/api/resend-verification', [
        'email' => $user->email
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Email already verified'
        ]);

    Notification::assertNothingSent();
});

test('returns not found if user does not exist', function () {
    Notification::fake();

    $response = $this->postJson('/api/resend-verification', [
        'email' => 'nonexistent@example.com',
    ]);

    $response->assertStatus(404)
        ->assertJson(['message' => 'User not found']);

    Notification::assertNothingSent();
});
