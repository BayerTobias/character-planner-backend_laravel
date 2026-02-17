<?php

namespace App\Data\Auth;

use App\Http\Requests\Auth\VerifyEmailRequest;

class VerifyEmailData
{
  public function __construct(
    public int $id,
    public string $hash,
  ) {
  }

  public static function fromRequest(VerifyEmailRequest $request): self
  {
    return new self(
      id: $request->validated('id'),
      hash: $request->validated('hash'),
    );
  }
}