<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidosController;

Route::get('users', [UserController::class, 'index']);

//User routes

//Register a new user
Route::post('register', [UserController::class, 'register']);

//Get all users with the initial
Route::get('users/{initial}', [UserController::class, 'usersWithInitial']);

//Number of orders of a user
Route::get('users/numorders/{id}', [UserController::class, 'numOrdersByUser']);

//Orders routes

//Get all the orders
Route::get('orders', [PedidosController::class, 'index']);

//Create a new order
Route::post('orders', [PedidosController::class, 'store']);

//Update an order
Route::put('orders/{id}', [PedidosController::class, 'update']);

//Delete an order
Route::delete('orders/{id}', [PedidosController::class, 'destroy']);

//Get all the orders of a user
Route::get('orders/user/{id}', [PedidosController::class, 'ordersByUser']);

//Get orders in a total range
Route::get('orders/total/{min}/{max}', [PedidosController::class, 'ordersInTotalRange']);

//Get all orders with the user in descending order sorted by total
Route::get('orders/totaldesc', [PedidosController::class, 'ordersWithUserDesc']);

//Get the total of all orders
Route::get('orders/total', [PedidosController::class, 'allOrdersTotal']);

//Get the cheapest order
Route::get('orders/cheapest', [PedidosController::class, 'cheapestOrder']);

//Get orders grouped by user
Route::get('orders/groupbyuser', [PedidosController::class, 'getOrdersGroupedByUser']);

