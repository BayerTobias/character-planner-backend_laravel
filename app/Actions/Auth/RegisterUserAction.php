<?php

namespace App\Actions\Auth;

use App\Data\Auth\RegisterUserData;
use App\Models\User;
use App\Repositories\Contracts\Auth\UserRepositoryInterface;

class RegisterUserAction
{
  public function __construct(
    private readonly UserRepositoryInterface $users
  ) {
  }

  public function execute(RegisterUserData $data): User
  {
    $user = $this->users->createFromRegistration($data);

    $user->sendEmailVerificationNotification();

    return $user;
  }
}