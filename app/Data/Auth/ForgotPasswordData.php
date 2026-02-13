<?php

namespace App\Data\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordData
{
  public function __construct(
    public readonly string $email,
  ) {
  }

  public static function fromRequest(ForgotPasswordRequest $request): self
  {
    return new self(
      email: $request->validated('email'),
    );
  }
}

