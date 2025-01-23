<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pedidos;

class UserController extends Controller
{

    //Get all users
    public function index(){
        $users = User::all();

        return response()->json([
            'data' => $users
        ],200);
    }
    //

    public function register(Request $request){
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ],201);
        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ],400);
        }
    }


    public function usersWithInitial($initial)
    {
        //Show all the users with the initial
        $users = User::where('name', 'like', $initial . '%')->get();

        return response()->json([
            'data' => $users
        ],200);
    }

    public function numOrdersByUser($id)
    {
        //Show the number of orders of a user
        $pedidos = Pedidos::where('user_id', $id)->count();

        return response()->json([
            'data' => $pedidos
        ],200);
    }
}
