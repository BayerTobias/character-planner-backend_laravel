<?php

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

test('resends verification email if user exists and is not verified', function () {
    Notification::fake();

    $user = User::factory()->create(['email_verified_at' => null]);

    $response = $this->postJson('/api/resend-verification', [
        'email' => $user->email,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'If your email is registered and not verified, you will receive a verification email shortly.'
        ]);

    Notification::assertSentTo($user, VerifyEmailNotification::class);
});

test('returns success even if user is already verified', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->postJson('/api/resend-verification', [
        'email' => $user->email,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'If your email is registered and not verified, you will receive a verification email shortly.'
        ]);

    Notification::assertNothingSent();
});

test('returns success even if user does not exist', function () {
    Notification::fake();

    $response = $this->postJson('/api/resend-verification', [
        'email' => 'nonexistent@example.com',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'If your email is registered and not verified, you will receive a verification email shortly.'
        ]);

    Notification::assertNothingSent();
});
