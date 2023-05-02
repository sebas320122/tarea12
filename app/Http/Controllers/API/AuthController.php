<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Agregar
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //funcion registro
    public function register(Request $request)
    {
        $valdiateData = $request->validate([
            'name' => 'required|max:255',
            'email'=> 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

        $valdiateData['password'] = Hash::make($request->password);

        $user = User::create($valdiateData);

        $accessToken = $user->createToken('authToken')->accessToken;

    return response([
        'user' => $user,
        'access_token' => $accessToken
    ]);
    }

    //funcion login 
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message' => 'datos invalidos']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
