<?php

namespace App\Actions\Auth;

use App\Data\Auth\GoogleUserData;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Str;

class GoogleLoginAction
{
  public function __construct(private UserRepositoryInterface $users)
  {
  }
  public function execute(GoogleUserData $googleUserData): string
  {
    $user = $this->users->findByEmail($googleUserData->email);

    if (!$user) {
      $password = Str::random(24);
      $user = $this->users->createFromGoogleLogin($googleUserData, $password);
      $user->email_verified_at = now();
      $this->users->update($user);
    }

    $user->tokens()->where('updated_at', '<', now()->subDays(7))->delete();

    return $user->createToken('auth_token')->plainTextToken;
  }
}