<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $status = 401;
        $response = ['error' => 'Unauthorised'];
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $status=200;
            $response=[
                'user' => Auth::user(),
                'name' => Auth::user()->name,
                'token'=> Auth::user()->createToken('Video4You')->accessToken,
            ];
        } 
        return response()->json($response, $status);
    }
    
}