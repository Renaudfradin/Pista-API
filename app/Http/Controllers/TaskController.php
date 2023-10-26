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

/**
* @OA\Get(
*     path="/api/task/{id}",
*     summary="Task page",
*     tags={"Task"},
*     security={{"bearerAuth":{}}},
*     @OA\Response(response="200", description="Success"),
* )
*
* @OA\Post(
*     path="/api/{id}/task",
*     summary="Register a new Task",
*     tags={"Task"},
*     @OA\Parameter(
*         name="name",
*         in="query",
*         description="Task's name",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="201", description="Todolist registered successfully"),
*     @OA\Response(response="422", description="Validation errors")
* )
*
* @OA\Put(
*     path="0/api/task/{id}",
*     summary="Update User",
*     tags={"Task"},
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
*     path="/api/task/{id}",
*     summary="Delete Todolist",
*     tags={"Task"},
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
