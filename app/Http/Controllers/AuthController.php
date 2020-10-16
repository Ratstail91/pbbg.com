<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a user and API token after a valid registration.
     *
     * @param  RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $data['token'] = $user->createToken('Token')->accessToken;
        return response()->json(['data' => $data], 200);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (auth('web')->attempt($request->validated())) {
            $user = auth('web')->user();
            $data['token'] = $user->createToken('Token')->accessToken;
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
