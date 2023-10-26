<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todolist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
* @OA\Get(
*     path="/api/me",
*     summary="User page",
*     tags={"User"},
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="Success"),
* )
*
* @OA\Delete(
*     path="/api/users/{id}",
*     summary="Delete User",
*     tags={"User"},
*     security={{"bearerAuth":{}}},
*     @OA\Parameter(
*         name="id",
*         in="query",
*         description="User Id",
*         required=true,
*         @OA\Schema(type="string")
*     ),
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
        $todoListCount = $user->todoLists->count();

        return response()->json([
            'userInfo' => $user, 
            'countTodo' => $todoListCount,
        ], 200);
    }

    public function update(Request $request, User $id)
    {
        $id->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'age' => $request->age,
            'gender' => $request->gender
        ]);

        return response()->json([
            'message' => 'User Updated'
        ], 201);
    }

    public function destroy(User $id)
    {
        $id->delete();

        return response()->json([
            'message' => 'User delete'
        ], 200);
    }
}
