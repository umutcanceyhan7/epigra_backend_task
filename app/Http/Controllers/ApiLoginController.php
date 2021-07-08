<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiLoginController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        #password hash
        $requestData = $request->all();
        $requestData['password'] = bcrypt($requestData['password']);

        $user = User::factory()->create($requestData);

        $resArr = [];

        $resArr['token'] = $user->createToken('apiAccessToken')->accessToken;
        $resArr['name'] = $user->name;

        return response()->json($resArr, 200);
    }

    public function login(Request $request)
    {
        # check credentials if its true create token and response it.
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $resArr = [];
            $resArr['token'] = $user->createToken('apiAccessToken')->accessToken;
            $resArr['name'] = $user->name;
            return response()->json($resArr, 200);
        } else {
            return response()->json(['error' => 'Unauthrized Access'], 203);
        }
    }
}
