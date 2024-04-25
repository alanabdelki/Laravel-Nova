<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8'
        ]);


        $user = User::create([

            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->accessToken->token;
        $user->assignRole('student');
        return response()->json(['user' => $user, 'access_token' => $token]);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken->token;


            return response()->json(['user' => $user, 'access_token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
