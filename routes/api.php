<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'test']);

//* Users */
Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

//* Todo list */
Route::get('/todolist', [TodolistController::class, 'todolist'])->middleware('auth:sanctum');
Route::get('/todo/{id}', [TodolistController::class, 'todo'])->middleware('auth:sanctum');
Route::post('/todo', [TodolistController::class, 'store'])->middleware('auth:sanctum');
Route::put('/todo/{id}', [TodolistController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/todo/{id}', [TodolistController::class, 'destroy'])->middleware('auth:sanctum');

//* Task */
Route::get('/task', [TaskController::class, ''])->middleware('auth:sanctum');
Route::post('/task', [TaskController::class, ''])->middleware('auth:sanctum');
Route::put('/task', [TaskController::class, ''])->middleware('auth:sanctum');
Route::delete('/task', [TaskController::class, ''])->middleware('auth:sanctum');

//* Category */
// Route::get('/register', [CategoryController::class, '']);
// Route::post('/register', [CategoryController::class, '']);
// Route::put('/register', [CategoryController::class, '']);
// Route::delete('/register', [CategoryController::class, '']);
