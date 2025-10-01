<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Verify a user's email address.
     *
     * This method handles the verification of a user's email address by checking
     * the provided ID and hash against the stored user data. If the hash matches
     * and the email is not yet verified, the email will be marked as verified.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id The ID of the user to verify.
     * @param  string $hash The verification hash to validate.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response indicating whether the verification was successful, already completed, or invalid.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the user with the given ID does not exist.
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification link'], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        } else {
            $user->markEmailAsVerified();
            return response()->json(['message' => 'Email successfully verified']);
        }
    }

    /**
     * Resend the email verification notification.
     *
     * This method validates the provided email, looks up the corresponding user,
     * and resends the email verification notification if the user exists and
     * has not already verified their email address.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming request containing the user's email.
     *
     * @return \Illuminate\Http\JsonResponse    A JSON response indicating the outcome:
     *                                          - Email sent
     *                                          - Already verified
     *                                          - User not found
     *
     * @throws \Illuminate\Validation\ValidationException If the email validation fails.
     */
    public function resend(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email sent']);
    }
}
