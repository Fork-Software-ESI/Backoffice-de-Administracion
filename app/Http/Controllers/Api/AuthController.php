<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function mostrarVistaLogin()
    {
        return view('api/login');
    }

    public function mostrarVistaHome()
    {
        return view('api/home');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:55|min:3|regex:/^\S*$/',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            session(['accessToken' => $accessToken]);
            return redirect()->route('auth.mostrarVistaHome');
        } else {
            session()->flash('mensaje', 'Credenciales inválidas');
            return redirect()->route('auth.login')->withErrors($validator)->withInput();
        }
    }
}
