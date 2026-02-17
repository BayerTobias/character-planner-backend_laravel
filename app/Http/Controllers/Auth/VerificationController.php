<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ResendVerificationAction;
use App\Actions\Auth\VerifyEmailAction;
use App\Data\Auth\ResendVerificationData;
use App\Data\Auth\VerifyEmailData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendVerificationRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;

class VerificationController extends Controller
{

    /**
     * Verify a user's email address.
     *
     * This endpoint validates the signed verification link parameters (id and hash)
     * and delegates the verification logic to the VerifyEmailAction. Depending on
     * the verification state, it returns a success message or indicates that the
     * email was already verified. If the verification link is invalid, an
     * InvalidVerificationLinkException is thrown and rendered as a 403 response.
     *
     * @param  \App\Http\Requests\Auth\VerifyEmailRequest  $request  The validated request containing the user id and verification hash.
     * @param  \App\Actions\Auth\VerifyEmailAction         $action   The action handling email verification logic.
     * @return \Illuminate\Http\JsonResponse                         JSON response with verification result message.
     *
     * @throws \App\Exceptions\InvalidVerificationLinkException      If the verification hash is invalid.
     */
    public function verify(VerifyEmailRequest $request, VerifyEmailAction $action)
    {
        $message = $action->execute(VerifyEmailData::fromRequest($request));

        return response()->json([
            'message' => $message
        ]);
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
