<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function register(Request $request){
        
        try{

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);


        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function login(Request $request){
        
        try{

            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8'
            ]);

            $credentials = $request->only('email', 'password');

            if(!Auth::attempt($credentials)){
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $user = $request->user();

            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully',
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ], 201);

        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function logout(Request $request){
        
        try{

            //Delete all tokens for the authenticated user
            $request->user()->tokens()->delete();

            return response()->json([
                'message' => 'User logged out successfully'
            ], 201);

        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }
}
