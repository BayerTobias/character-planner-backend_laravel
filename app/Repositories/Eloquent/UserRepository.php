<?php

namespace App\Repositories\Eloquent;

use App\Data\Auth\RegisterUserData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
  public function createFromRegistration(RegisterUserData $data): User
  {
    $user = User::create([
      'name' => $data->name,
      'email' => $data->email,
      'password' => Hash::make($data->password)
    ]);

    return $user;
  }

  public function findByEmail(string $email): ?User
  {
    return User::where('email', $email)->first();
  }

  public function findVerifiedByEmail(string $email): ?User
  {
    return User::where('email', $email)
      ->whereNotNull('email_verified_at')
      ->first();
  }
}