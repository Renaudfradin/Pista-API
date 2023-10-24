<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
* @OA\Get(
*     path="/api/me",
*     summary="User page",
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="Success"),
* )

* @OA\Delete(
*     path="/api/users/{id}",
*     summary="Delete User",
*     @OA\Parameter(
*         name="",
*         in="query",
*         description="User Id",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="User delete"),
* )
*/

class UserController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public function me(Request $request)
    {
        $user = $request->user();
        $todoList = $user->todoLists->all();

        return response()->json(['userInfo' => $user], 200);
    }

    public function update(Request $request, User $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'email' => 'required|max:255|min:3|email',
            'password' => 'required|max:255|min:5',
        ]);

        $id->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $id->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Usser Updated'
        ], 201);
    }

    public function destroy(User $id)
    {
        $id->delete();

        return response()->json(['message' => 'User delete'], 200);
    }
}
