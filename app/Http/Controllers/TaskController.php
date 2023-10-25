<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Todolist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class TaskController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;

    public function show(Task $id)
    {
        $task = $id;
        return response()->json([ 
            'task' => $task
        ], 200);
    }

    public function createTask(Request $request, TodoList $idtodo)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
        ]);

        $task = Task::create([
            'name' => $request->name,
            'todolist_id' => $idtodo->id,
            'complete' => 0,
            'user_id' => $request->user()->id,
            'published_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'message' => 'Task created',
            'task' => $task
        ], 201);
    }

    public function updateTask(Request $request, Task $id, TodoList $idtodo)
    {
        //dd($request->user()->id);
        $userId = $request->user()->id;
        $id->update([
            'name' => $request->name,
            'todolist_id' => $idtodo->id,
            'complete' => $request->complete,
            'user_id' => $userId,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Task updated'
        ], 200);
    }

    public function destroy(Task $id)
    {
        $id->delete();

        return response()->json([
            'message' => 'Task delete'
        ], 200);
    }
}
