<?php

namespace App\Actions\Auth;

use App\Data\Auth\LoginUserData;
use App\Exceptions\InvalidCredentialsException;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class LoginUserAction
{
  public function __construct(
    private UserRepositoryInterface $users
  ) {
  }

  public function execute(LoginUserData $data): string
  {
    $user = $this->users->findVerifiedByEmail($data->email);

    if (!$user || !Hash::check($data->password, $user->password)) {
      throw new InvalidCredentialsException();
    }

    $user->tokens()->where('updated_at', '<', now()
      ->subDays(7))
      ->delete();

    return $user->createToken('auth_token')->plainTextToken;
  }
}