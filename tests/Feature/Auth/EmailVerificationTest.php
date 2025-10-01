<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;

uses(RefreshDatabase::class);

test('verifies email with correct id and hash', function () {
    $user = User::factory()->create([
        'email_verified_at' => null
    ]);

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
    );

    $response = $this->getJson($url);

    $response->assertStatus(200)->assertJson(
        ['message' => 'Email successfully verified']
    );

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});

test('returns error for invalid hash', function () {
    $user = User::factory()->create([
        'email_verified_at' => null
    ]);

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wronghash')]
    );

    $response = $this->getJson($url);

    $response->assertStatus(403)->assertJson(
        ['message' => 'Invalid verification link']
    );
});

test('returns already verified if email is already verified', function () {
    $user = User::factory()->create();

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
    );

    $response = $this->getJson($url);

    $response->assertStatus(200)->assertJson(
        ['message' => 'Email already verified']
    );

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});
