<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register (Request $request){

        $campos = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required','string', Rule::unique(User::class)],
            'lastname' => ['required', 'string'],
            'dni' => ['required', Rule::unique(User::class)],
            'password'=> ['required','string','confirmed']
        ]);

        $user = User::create([
            'name' => $campos['name'],
            'lastname' => $campos['lastname'],
            'email' => $campos['email'],
            'dni' => $campos['dni'],
            'password'=> bcrypt($campos['password'])
        ]);

       return response()->json([
            'user' => $user,
            'message' => 'Usuario creado de manera correcta'
        ], 201);

    }

    public function login (Request $request){
        
        $campos = $request->validate([
            'email' => ['required','string'],
            'password'=> ['required','string']
        ]);

        $user = User::where('email', $campos['email'])->first();

        if(!$user || !Hash::check($campos['password'], $user->password)){

            return response()->json([
                'message' => 'usuario o contraseña incorrectas'
            ],401);

        }

        $token = $user->createToken('miToken')->plainTextToken;

       return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);

    }

    public function logout(Request $request){
        
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Sesión cerrada'
        ],201);

    }
}