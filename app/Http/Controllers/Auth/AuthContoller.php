<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

use function Pest\Laravel\json;

class AuthContoller extends Controller
{
    /**
     * Handle a new user registration request.
     *
     * This method validates the incoming request, creates a new user record,
     * hashes the password, sends the email verification notification,
     * and returns a JSON response with the created user.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming registration request containing name, email, and password.
     * @return \Illuminate\Http\JsonResponse       A JSON response with success message and created user data.
     *
     * @throws \Illuminate\Validation\ValidationException  If the validation fails.
     */
    public function register(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);


        $user = User::where('email', $credentials['email'])
            ->whereNotNull('email_verified_at')
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user->tokens()->where('updated_at', '<', now()->subDays(7))->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function checkAuth()
    {
        return response()->json(

            ['message' => 'Authenticated']

        );
    }

    public function logout(Request $request)
    {
        /** @var PersonalAccessToken|null $token */
        $token = $request->user()->currentAccessToken();

        if ($token) {
            $token->delete();
        }

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
