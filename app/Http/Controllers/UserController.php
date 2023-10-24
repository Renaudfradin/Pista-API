<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;
    // public function destroy(User $id)
    // {
    //     $id->delete();

    //     return response()->json(['message' => 'User delete'], 200);
    // }

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
}
