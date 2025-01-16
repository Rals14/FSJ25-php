<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Register a new user
Route::post('register', [UserController::class, 'register']);

//Login a user
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group( function () {
    //Logout a user
    Route::post('logout', [UserController::class, 'logout']);
});
