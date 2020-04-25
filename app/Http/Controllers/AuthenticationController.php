<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->validateForPassportPasswordGrant($request->password) == $user->password) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'data' => [
                        'token' => $token,
                    ],
                ];
                return response($response, 200);
            } else {
                $response = 'Password mismatch';
                return response($response, 422);
            }
        } else {
            $response = 'Password mismatch';
            return response($response, 422);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $request->user()->token()->delete();
        $response = 'You have been successfully logged out!';
        return response($response, 200);
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];

        return response($response, 200);

    }

    public function verify(Request $request)
    {
        $user = User::where('name', $request->name)->first();

        if($user)
        {
            // return $user->id;
            return response()->json(['bio' => $user->bio]);
        }
    }
}
