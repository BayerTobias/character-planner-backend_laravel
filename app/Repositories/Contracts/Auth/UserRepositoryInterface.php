<?php

namespace App\Repositories\Contracts\Auth;

use App\Data\Auth\GoogleUserData;
use App\Data\Auth\RegisterUserData;
use App\Models\User;

interface UserRepositoryInterface
{
  public function createFromRegistration(RegisterUserData $data): User;
  public function createFromGoogleLogin(GoogleUserData $data, string $password): User;
  public function update(User $user): User;

  public function findByEmail(string $email): ?User;

  public function findById(int $id): ?User;

  public function findVerifiedByEmail(string $email): ?User;
}