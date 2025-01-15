<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Routes for users API

//Register a new user
Route::post('register', [UserController::class, 'register']);

//Login a user
Route::post('login', [UserController::class, 'login']);



//Routes for tasks API

//
Route::middleware('auth:sanctum')->group( function(){
    //Logout a user
    Route::post('logout', [UserController::class, 'logout']);
    //Get all tasks
    Route::get('tasks', [TaskController::class, 'index']);
    //Create a new task
    Route::post('tasks', [TaskController::class, 'store']);
    //update a task
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    //delete a task
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
});