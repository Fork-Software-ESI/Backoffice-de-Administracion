<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    protected $redirectTo = '/home';
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('authToken')->accessToken;
            return redirect()->route('home');
        }
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        $user->tokens->each(function ($token) {
            $token->revoke();
        });

        auth()->logout();
        return redirect()->route('login')->with('error', $user->username . ' ha cerrado sesión');
    }

}