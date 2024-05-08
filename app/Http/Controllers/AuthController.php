<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        try {
            $request->validate(
                [
                    'email' => 'required|unique:users,email|email',
                    'name' => 'required',
                    'password' => 'required|min:6',
                    'role' => 'required'
                ]
            );

            $user = User::create([
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role')
            ]);

            $data['user'] = $user;

            return response()->json([
                'response_code' => '00',
                'response_message' => 'register berhasil',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $th->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'emailPhone' => 'required',
                'password' => 'required',
            ]);
            $user_login = User::where('email', $request->emailPhone)->orWhere('phone', $request->emailPhone)->first();
            if (!$user_login || !Hash::check($request->password, $user_login->password)) {
                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'Email atau password salah',
                ], 401);
            }
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Login berhasil',
                'data' => [
                    'user' => $user_login,
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $th->getMessage(),
            ], 500);
        }
    }
}
