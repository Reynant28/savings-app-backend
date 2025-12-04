<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function LoginUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = UsersModel::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['email atau password salah.'],
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ]);
    }


    public function RegisterUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);

        }

        $user = UsersModel::create([

            'username' => $request->username,

            'email' => $request->email,

            'password' => Hash::make($request->password),

        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([

            'status' => 'success',

            'message' => 'User berhasil didaftarkan',

            'user' => $user,

            'token' => $token,

        ], 201);
    }

    public function LogoutUser(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil logout',
        ]);
    }


    public function GetCurrentUser(Request $request)
    {
        return response()->json([

            'status' => 'success',

            'user' => $request->user()

        ]);
    }
}
