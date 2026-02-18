<?php

namespace App\Actions\Auth;

use App\Data\Auth\ResendVerificationData;
use App\Repositories\Contracts\Auth\UserRepositoryInterface;

class ResendVerificationAction
{

  public function __construct(
    private UserRepositoryInterface $users
  ) {
  }

  public function execute(ResendVerificationData $data): void
  {
    $user = $this->users->findByEmail($data->email);

    if (!$user || $user->hasVerifiedEmail()) {
      return;
    }

    $user->sendEmailVerificationNotification();
  }
}