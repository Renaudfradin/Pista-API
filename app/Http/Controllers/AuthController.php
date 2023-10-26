<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
* @OA\Post(
*     path="/api/register",
*     summary="Register a new user",
*     tags={"User"},
*     @OA\Parameter(
*         name="name",
*         in="query",
*         description="User's name",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Parameter(
*         name="email",
*         in="query",
*         description="User's email",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Parameter(
*         name="password",
*         in="query",
*         description="User's password",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="201", description="User registered successfully"),
*     @OA\Response(response="422", description="Validation errors")
* )
*
* @OA\Post(
*     path="/api/login",
*     summary="Authenticate user and generate Bearer token",
*     tags={"User"},
*     @OA\Parameter(
*         name="email",
*         in="query",
*         description="User's email",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Parameter(
*         name="password",
*         in="query",
*         description="User's password",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="200", description="Login successful"),
*     @OA\Response(response="401", description="Invalid credentials")
* )
*
* @OA\Post(
*     path="/api/logout",
*     summary="Logout session",
*     tags={"User"},
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="Successfully logged out"),
* )
*/
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user 
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'email' => 'required|max:255|min:3|email|unique:users,email',
            'password' => 'required|max:255|min:5',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ],200);
    }
}
