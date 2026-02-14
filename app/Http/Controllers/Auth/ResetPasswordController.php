<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ResetPasswordAction;
use App\Data\Auth\ResetPasswordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    /**
     * Handle an incoming password reset request.
     *
     * This endpoint accepts a valid password reset token, the user's email,
     * and a new password. The request data is validated via ResetPasswordRequest.
     * If the provided token is valid and the reset succeeds, a success response
     * is returned. Otherwise, an error message is returned.
     *
     * @param  \App\Http\Requests\Auth\ResetPasswordRequest  $request
     * @param  \App\Actions\Auth\ResetPasswordAction  $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $action)
    {

        $status = $action->execute(ResetPasswordData::fromRequest($request));

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password successfully reset.'], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }
}
