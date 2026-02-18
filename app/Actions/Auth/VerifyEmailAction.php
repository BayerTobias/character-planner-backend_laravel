<?php

namespace App\Actions\Auth;

use App\Data\Auth\VerifyEmailData;
use App\Exceptions\InvalidVerificationLinkException;
use App\Repositories\Contracts\Auth\UserRepositoryInterface;

class VerifyEmailAction
{

  public function __construct(
    private UserRepositoryInterface $users
  ) {
  }

  public function execute(VerifyEmailData $data): string
  {
    $user = $this->users->findById($data->id);

    if (!$user) {
      return 'Invalid verification link';
    }

    if (!hash_equals($data->hash, sha1($user->getEmailForVerification()))) {
      throw new InvalidVerificationLinkException();
    }

    if ($user->hasVerifiedEmail()) {
      return 'Email already verified';
    }

    $user->markEmailAsVerified();

    return 'Email successfully verified';
  }
}