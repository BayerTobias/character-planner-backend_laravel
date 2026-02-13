<?php

namespace App\Actions\Auth;

use App\Data\Auth\ForgotPasswordData;
use Illuminate\Support\Facades\Password;

class ForgotPasswordAction
{
  public function execute(ForgotPasswordData $data): void
  {
    Password::sendResetLink(['email' => $data->email]);
  }
}