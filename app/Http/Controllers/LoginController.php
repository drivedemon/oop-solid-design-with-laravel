<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $user = User::where('login_username', $payload['username'])->first();

        if ($user && Hash::check($payload['password'], $user->login_password)) {
            $token = $user->createToken('authToken');

            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
                'user' => array_merge($user->toArray(), ['token' => $token->plainTextToken]),
                'token' => $token->plainTextToken,
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }
    }

    public function checkCredential(LoginUserRequest $request): JsonResponse
    {
        $payload = $request->validated();

        try {
            $user = User::where('login_username', $payload['username'])->first();
            if ($user) {
                if (! Hash::check($payload['password'], $user->login_password)) {
                    return response()->json(['status' => 401, 'message' => 'Invalid credentials.'], 401);
                }

                return response()->json(['status' => 200, 'message' => 'Loggedin successfully!']);
            }

            return response()->json(['status' => 401, 'message' => 'No account found with these credentials.'], 401);
        } catch (\Exception $err) {
            return response()->json(['status' => 500, 'message' => 'Something went wrong!'], 500);
        }
    }

    public function logout(): JsonResponse
    {
        /** @var PersonalAccessToken $token */
        $token = auth()->user()->currentAccessToken();
        $token->delete();

        return response()->json(['message' => 'logged out']);
    }
}
