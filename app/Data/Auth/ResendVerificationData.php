<?php

namespace App\Data\Auth;

use App\Http\Requests\Auth\ResendVerificationRequest;

class ResendVerificationData
{

  public function __construct(
    public string $email
  ) {
  }

  public static function fromRequest(ResendVerificationRequest $request): self
  {
    return new self(
      email: $request->validated('email')
    );
  }
}