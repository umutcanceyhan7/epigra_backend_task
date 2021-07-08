<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        # If user could not login
        if (!Auth::attempt($login)) {
            return response(['message' => 'Invalid login credentials'], 401);
        }

        $accessToken = Auth::user()->createToken('apiAuthToken')->accessToken;

        return response(['user' => Auth::user(), 'apiAuthToken' => $accessToken]);
    }
}
