<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\RegisterUserAction;
use App\Data\Auth\LoginUserData;
use App\Data\Auth\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
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


    public function login(LoginUserRequest $request, LoginUserAction $action)
    {
        $token = $action->execute(LoginUserData::fromRequest($request));

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
