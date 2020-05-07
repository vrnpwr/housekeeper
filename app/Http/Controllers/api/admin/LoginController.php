<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request){
       $login =  $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if( !Auth::attempt( $login)) {
            return response(['message' => 'Invalid login credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user'=>Auth::user(), 'access_token' => $accessToken]);
    }

    public function all()
    {
        return User::all();
    }
}
