<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

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
            'chek' => $request->chek,
            'user_id' => $request->user()->id,
            'published_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Todolist created'
        ], 201);
    }

    public function update(Request $request, Todolist $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
        ]);

        dd($id);
        $id->update([
            'name' => $request->name,
            'chek' => $request->chek,
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
