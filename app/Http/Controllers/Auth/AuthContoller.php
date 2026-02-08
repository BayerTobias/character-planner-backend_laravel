<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterUserAction;
use App\Data\Auth\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

use function Pest\Laravel\json;

class AuthContoller extends Controller
{
    /**
     * Register a new user.
     *
     * This endpoint handles user registration by validating the incoming request,
     * delegating the registration process to the RegisterUserAction,
     * and returning the newly created user as an API resource.
     *
     * The user is created in an unverified state and receives
     * an email verification notification.
     *
     * @param  \App\Http\Requests\Auth\RegisterUserRequest  $request
     *         Validated registration data (name, email, password).
     *
     * @param  \App\Actions\Auth\RegisterUserAction  $action
     *         Handles the user registration use-case.
     *
     * @return \Illuminate\Http\JsonResponse
     *         JSON response containing the registered user resource.
     */
    public function register(RegisterUserRequest $request, RegisterUserAction $action)
    {
        $user = $action->execute(RegisterUserData::fromRequest($request));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Handle a user login request.
     *
     * This method validates the incoming request for email and password, checks if the user exists
     * and has a verified email, verifies the password, deletes old tokens older than 7 days,
     * creates a new authentication token, and returns a JSON response with the token.
     *
     * @param  \Illuminate\Http\Request  $request   The incoming login request containing email and password.
     * @return \Illuminate\Http\JsonResponse        A JSON response with a success message, access token, and token type.
     *
     * @throws \Illuminate\Validation\ValidationException  If the validation of email or password fails.
     */
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

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Check if the current user is authenticated.
     *
     * This endpoint returns a JSON response indicating that the user
     * is authenticated. It is protected by auth middleware
     * to ensure only authenticated users can access it.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth()
    {
        return response()->json(

            ['message' => 'Authenticated']

        );
    }

    /**
     * Log out the currently authenticated user.
     *
     * This endpoint deletes the user's current personal access token,
     * effectively logging them out. It is protected by auth middleware
     * to ensure only authenticated users can access it.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
