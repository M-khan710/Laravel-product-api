<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    // Registration of User
    function register(Request $request){
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique',
                'password' => 'required|confirmed|min:6'
            ]);
            // Create the user if validation passes
            $user = User::create([
              'name' => $request->input('name'), 
              'email' => $request->input('email'),
              'password' => Hash::make($request->input('password')) 
            ]);
            return response()->json([
              'message' => 'User successfully registered.',
              'user' => $user
            ], 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
    //Generate the token of user
    public function createToken(Request $request){
       
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
          
        $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    // Generate a token for the user
    $token = $user->createToken('YourAppName')->plainTextToken;
    return response()->json(['token' => $token]);
            return response()->json([
              'message' => 'User successfully registered.',
              'user' => $user
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }
    // Display message if token is not correct
    public function notAuthorize(){
        return response()->json([
            'message' => 'Correct token is required',
            
        ], 422); 
    }
}
