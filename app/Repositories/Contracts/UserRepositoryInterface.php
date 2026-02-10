<?php

namespace App\Repositories\Contracts;

use App\Data\Auth\RegisterUserData;
use App\Models\User;

interface UserRepositoryInterface
{
  public function createFromRegistration(RegisterUserData $data): User;

  public function findVerifiedByEmail(string $email): ?User;
}