<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;
use Laravel\Socialite\Contracts\Provider as SocialiteProvider;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Mockery;

uses(RefreshDatabase::class);

it('redirects to google for authentication', function () {
    $providerMock = Mockery::mock(SocialiteProvider::class);
    $providerMock->shouldReceive('stateless')->once()->andReturnSelf();
    $providerMock->shouldReceive('redirect')->once()->andReturn(
        redirect('https://accounts.google.com/o/oauth2/auth')
    );

    $factoryMock = Mockery::mock(SocialiteFactory::class);
    $factoryMock->shouldReceive('driver')->with('google')->once()->andReturn($providerMock);


    $this->app->instance(SocialiteFactory::class, $factoryMock);

    $response = $this->get('/api/google');

    $response->assertRedirect('https://accounts.google.com/o/oauth2/auth');
});

it('creates or updates user and redirects with token on Google callback', function () {
    // Fake Google-User
    $googleUserMock = Mockery::mock(SocialiteUser::class);
    $googleUserMock->shouldReceive('getEmail')->andReturn('test@example.com');
    $googleUserMock->shouldReceive('getName')->andReturn('Test User');

    // Fake Provider
    $providerMock = Mockery::mock(SocialiteProvider::class);
    $providerMock->shouldReceive('stateless')->andReturnSelf();
    $providerMock->shouldReceive('user')->andReturn($googleUserMock);

    // Factory
    $factoryMock = Mockery::mock(SocialiteFactory::class);
    $factoryMock->shouldReceive('driver')->with('google')->andReturn($providerMock);

    $this->app->instance(SocialiteFactory::class, $factoryMock);

    // Call endpoint
    $response = $this->get('/api/google/callback');


    $response->assertRedirectContains(config('app.frontend_url') . '/token-accept?token=');

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'name' => 'Test User',
    ]);

    $user = User::where('email', 'test@example.com')->first();
    expect($user->tokens)->not->toBeEmpty();
});

it('redirects to login with error when Google throws exception', function () {
    $providerMock = Mockery::mock(SocialiteProvider::class);
    $providerMock->shouldReceive('stateless')->andReturnSelf();
    $providerMock->shouldReceive('user')->andThrow(new Exception('Google error'));

    $factoryMock = Mockery::mock(SocialiteFactory::class);
    $factoryMock->shouldReceive('driver')->with('google')->andReturn($providerMock);

    $this->app->instance(SocialiteFactory::class, $factoryMock);

    // Call endpoint
    $response = $this->get('/api/google/callback');

    $response->assertRedirectContains(config('app.frontend_url') . '/login?error=');
});