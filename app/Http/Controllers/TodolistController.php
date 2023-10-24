<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodolistRequest;
use App\Http\Requests\UpdateTodolistRequest;
use App\Models\Todolist;
use Illuminate\Support\Facades\Request;

class TodolistController extends Controller
{
    public function index()
    {
        $todos = Todolist::all();

        return response()->json($todos, 200);
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|max:255|min:3',
    //         'email' => 'required|max:255|min:3|email|unique:users,email',
    //         'password' => 'required|max:255|min:5',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     return response()->json(['message' => 'User created'], 201);
    // }

    // public function show(User $id)
    // {
    //     $user = User::find($id);

    //     return response()->json($user, 200);
    // }

    // public function update(Request $request, User $id)
    // {

    //     $this->validate($request, [
    //         'name' => 'required|max:255|min:3',
    //         'email' => 'required|max:255|min:3|email',
    //         'password' => 'required|max:255|min:5',
    //     ]);

    //     $id->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     return response()->json(['message' => 'User updated'], 400);
    // }

    // public function destroy(User $id)
    // {
    //     $id->delete();

    //     return response()->json(['message' => 'User delete'], 200);
    // }
}
