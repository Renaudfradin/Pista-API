<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

/**
* @OA\Get(
*     path="/api/todolist",
*     summary="Todolists page",
*     tags={"Todo"},
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="Success"),
* )
*
* @OA\Get(
*     path="/api/todo/{1}",
*     summary="Todolist page",
*     tags={"Todo"},
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="Success"),
* )
*
* @OA\Post(
*     path="/api/todo",
*     summary="Register a new Todolist",
*     tags={"Todo"},
*     @OA\Parameter(
*         name="name",
*         in="query",
*         description="User's name",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="201", description="Todolist registered successfully"),
*     @OA\Response(response="422", description="Validation errors")
* )
*
* @OA\Put(
*     path="/api/user/{id}",
*     summary="Update User",
*     tags={"Todo"},
*     security={{"bearerAuth":{}}},
*     @OA\Parameter(
*         name="",
*         in="query",
*         description="User Id",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="200", description="User delete"),
* )
*
* @OA\Delete(
*     path="/api/todo/{id}",
*     summary="Delete Todolist",
*     tags={"Todo"},
*     security={{"bearerAuth":{}}},
*     @OA\Parameter(
*         name="",
*         in="query",
*         description="User Id",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="200", description="Todoliste delete"),
* )
*/

class TodolistController extends Controller
{
    public function todolist(Request $request)
    {
        $userId = $request->user()->id;
        $todos = Todolist::where('user_id', $userId)->get();
        $tasks = [ ];

        foreach ($todos as $todo) { 
            $tasks = $todo->tasks;
        }

        return response()->json([
            'todoList' => $todos
        ], 200);
    }

    public function todo(Request $request, Todolist $id)
    {
        $todo = $request->id;
        $tasks = $todo->tasks;
        $tasksCount = $todo->tasks->count();
        $completeTasks = $todo->tasks->where('complete', true)->count();

        return response()->json([ 
            'todo' => $todo,
            'taskscount' => $tasksCount,
            'completetasks' => $completeTasks,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
        ]);

        $user = Todolist::create([
            'name' => $request->name,
            'user_id' => $request->user()->id,
            'published_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Todolist created'
        ], 201);
    }

    public function update(Request $request, Todolist $id)
    {
        $id->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'TodoList updated'
        ], 400);
    }

    public function destroy(Todolist $id)
    {
        $id->delete();

        return response()->json([
            'message' => 'Todoliste delete'
        ], 200);
    }
}
