<?php

namespace App\Data\Auth;

use App\Http\Requests\Auth\LoginUserRequest;

class LoginUserData
{
  public function __construct(
    public string $email,
    public string $password
  ) {
  }

  public static function fromRequest(LoginUserRequest $request): self
  {
    return new self(
      email: $request->validated('email'),
      password: $request->validated('password')
    );
  }
}

