<?php

namespace App\Data\Auth;

use App\Http\Requests\Auth\RegisterUserRequest;

class RegisterUserData
{
  public function __construct(
    public string $name,
    public string $email,
    public string $password
  ) {
  }

  public static function fromRequest(RegisterUserRequest $request): self
  {
    return new self(
      name: $request->validated('name'),
      email: $request->validated('email'),
      password: $request->validated('password')
    );
  }
}

