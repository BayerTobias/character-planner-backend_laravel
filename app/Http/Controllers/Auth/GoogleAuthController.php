<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $googleProvider */
        $googleProvider = Socialite::driver('google');
        return $googleProvider->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $googleProvider */
            $googleProvider = Socialite::driver('google');
            $googleUser = $googleProvider->stateless()->user();



            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => Hash::make(Str::random(24)),

                ]
            );

            $user->email_verified_at = now();
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect(config('app.frontend_url') . '/login?token=' . $token);

        } catch (Exception $error) {
            return redirect(config('app.frontend_url') . '/login?error=' . $error);
        }
    }
}
