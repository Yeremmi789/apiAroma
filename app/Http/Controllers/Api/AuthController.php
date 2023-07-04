<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'email' => 'required|string|max:255',
            'password' => 'required|string|max:8'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // $token = $user->createToken('auth_token')->plainTextToken;
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            // 'access_token' => $token,
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',

        ]);
    }

    public function login(Request $request)
    {
        $bandera = false;

        $credenciales = $request->validate([
            // 'email'=>['required', 'email'],
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $nombre_buscar = $request->email;

        if (Auth::attempt($credenciales)) {
            $users = User::join('roles', 'users.rol_id', '=', 'roles.id')
                ->where('users.email', $nombre_buscar)->first();
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return response([
                "token" => $token,
                "mssg" => "credenciales correctas",
                "ok" => !$bandera,
                "id" => $users->id,
                "name" => $users->name,
                "email" => $users->email,
                "role" => $users->rol,
            ], 200);
        } else {
            return response()->json([
                "mssg" => "credenciales incorrectas",
                "ok" => $bandera
            ], 401);
        }
    }
}
