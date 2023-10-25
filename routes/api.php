<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

//* Users */
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::put('/user/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

//* Todo list */
Route::get('/todolist', [TodolistController::class, 'todolist'])->middleware('auth:sanctum');
Route::get('/todo/{id}', [TodolistController::class, 'todo'])->middleware('auth:sanctum');
Route::post('/todo', [TodolistController::class, 'store'])->middleware('auth:sanctum');
Route::put('/todo/{id}', [TodolistController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/todo/{id}', [TodolistController::class, 'destroy'])->middleware('auth:sanctum');

//* Task */
Route::get('/task/{id}', [TaskController::class, 'show'])->middleware('auth:sanctum');
Route::post('/{idtodo}/task', [TaskController::class, 'createTask'])->middleware('auth:sanctum');
Route::put('/task/{id}', [TaskController::class, 'updateTask'])->middleware('auth:sanctum');
Route::delete('/task/{id}', [TaskController::class, 'destroy'])->middleware('auth:sanctum');

//* Category */
//Route::get('/category/{id}', [CategoryController::class, ''])->middleware('auth:sanctum');
//Route::post('/category/{id}', [CategoryController::class, ''])->middleware('auth:sanctum');
//Route::put('/category/{id}', [CategoryController::class, ''])->middleware('auth:sanctum');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');