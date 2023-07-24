<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return response()->json(['user' => Auth::user(), 'access_token' => $accessToken]);
        } else {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    }
}
