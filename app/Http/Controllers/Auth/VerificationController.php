<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ResendVerificationAction;
use App\Data\Auth\ResendVerificationData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendVerificationRequest;
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
     * This endpoint accepts an email via the ResendVerificationRequest and
     * triggers the ResendVerificationAction. If the email belongs to a user
     * who exists and is not yet verified, a verification email will be sent.
     * 
     * For security reasons, the response does not indicate whether the user
     * exists or is already verified. The same success message is returned
     * in all cases.
     *
     * @param \App\Http\Requests\Auth\ResendVerificationRequest $request The validated request containing the email.
     * @param \App\Actions\Auth\ResendVerificationAction $action The action handling the resend logic.
     * 
     * @return \Illuminate\Http\JsonResponse JSON response with a generic success message.
     */
    public function resend(ResendVerificationRequest $request, ResendVerificationAction $action)
    {
        $action->execute(ResendVerificationData::fromRequest($request));

        return response()->json([
            'message' => 'If your email is registered and not verified, you will receive a verification email shortly.'
        ]);
    }
}
