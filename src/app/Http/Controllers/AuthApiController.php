<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function response($user)
    {
        $token = $user->createToken( str()->random(40) )->plainTextToken;

        return response()->json([
            'usesr' =>  $user,
            'token' =>  $token,
            'token_type'    =>  'Bearer'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' =>  'required|email|unique:users',
            'password'  =>  'required|min:4|confirmed'
        ]);

        $user = User::create([
            'email' =>  $request->email,
            'password'  =>  Hash::make($request->password)
        ]);

        return response($user);
    }

    public function login(Request $request)
    {
        $cred = $request->validate([
            'email' =>  'required|email|exists:users',
            'password'  =>  'required|min:4'
        ]);

        if ( !Auth::attempt($cred)) {
            return response()->json([
                'message'   =>  'Unauthorized.'
            ], 401);
        }

        return $this->response(Auth::user());
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message'   =>  'You have successfully logged out.'
        ]);
    }
}
