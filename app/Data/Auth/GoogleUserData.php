<?php

namespace App\Data\Auth;

class GoogleUserData
{
  public function __construct(
    public readonly string $name,
    public readonly string $email,
  ) {
  }

  public static function fromSocialite(\Laravel\Socialite\Contracts\User $googleUser): self
  {
    return new self(
      name: $googleUser->getName(),
      email: $googleUser->getEmail(),
    );
  }
}