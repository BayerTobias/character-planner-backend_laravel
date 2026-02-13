<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ForgotPasswordAction;
use App\Data\Auth\ForgotPasswordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{

    public function sendPasswordResetEmail(ForgotPasswordRequest $request, ForgotPasswordAction $action)
    {
        $action->execute(ForgotPasswordData::fromRequest($request));

        return response()->json(['message' => 'If your email exists, you will receive a reset link.'], 200);
    }
}
