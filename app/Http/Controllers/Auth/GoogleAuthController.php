<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\GoogleLoginAction;
use App\Data\Auth\GoogleUserData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class GoogleAuthController extends Controller
{
    /**
     * Redirects the user to Google to initiate the OAuth authentication process.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $googleProvider */
        $googleProvider = Socialite::driver('google');
        return $googleProvider->stateless()->redirect();
    }

    /**
     * Handles the callback from Google after successful authentication.
     * 
     * - Finds or creates a user based on Google account data.
     * - Generates an API token for authentication.
     * - Redirects to the frontend with the token or an error message.
     *
     * @param \App\Actions\Auth\GoogleLoginAction $action
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function handleGoogleCallback(GoogleLoginAction $action)
    {
        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $googleProvider */
            $googleProvider = Socialite::driver('google');
            $googleUser = $googleProvider->stateless()->user();

            $token = $action->execute(GoogleUserData::fromSocialite($googleUser));

            return redirect(config('app.frontend_url') . '/token-accept?token=' . urlencode($token));

        } catch (Exception $error) {
            return redirect(config('app.frontend_url') . '/login?error=' . $error->getMessage());
        }
    }
}
