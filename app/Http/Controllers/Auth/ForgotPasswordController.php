<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Send a password reset link to the given email address.
     *
     * This endpoint validates the provided email and attempts to send
     * a password reset link using Laravel's password broker. If successful,
     * a JSON response with a success message is returned. If the email
     * does not exist or the link cannot be sent, a JSON error response
     * is returned.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent.'
            ], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }
}
