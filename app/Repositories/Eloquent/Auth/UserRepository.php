<?php

namespace App\Repositories\Eloquent\Auth;

use App\Data\Auth\GoogleUserData;
use App\Data\Auth\RegisterUserData;
use App\Models\User;
use App\Repositories\Contracts\Auth\UserRepositoryInterface;
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

  public function createFromGoogleLogin(GoogleUserData $data, string $password): User
  {
    $user = User::create([
      'name' => $data->name,
      'email' => $data->email,
      'password' => Hash::make($password),
    ]);

    return $user;
  }

  public function update(User $user): User
  {
    $user->save();
    return $user;
  }

  public function findByEmail(string $email): ?User
  {
    return User::where('email', $email)->first();
  }

  public function findById(int $id): ?User
  {
    return User::find($id);
  }

  public function findVerifiedByEmail(string $email): ?User
  {
    return User::where('email', $email)
      ->whereNotNull('email_verified_at')
      ->first();
  }
}