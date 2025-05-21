<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login (Request $request) {
        $request->validate([
            'nick_user' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('nick_user', $request->nick_user)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso!',
            'token_type' => 'Bearer',
            'user' => $user->name_user . ' ' . $user->ape_pat_user . ' ' . $user->ape_mat_user,
            'token' => $token // Comment for security reasons
        ], 200);
    }

    public function logout (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Sesión cerrada exitosamente!'
        ], 200);
    }
}
