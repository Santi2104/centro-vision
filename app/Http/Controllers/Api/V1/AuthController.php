<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Library\apiHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    use apiHelper;

    public function register (Request $request){

        $campos = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required','string', Rule::unique(User::class)],
            'lastname' => ['required', 'string'],
            'dni' => ['required', Rule::unique(User::class)],//Sacar esta regla y colocarla en otro lado
            'dni_type' => ['required'],
            'password'=> ['required','string','confirmed'],
            'celular' => ['required'],
            'o_s_id' => ['required']
        ]);

        $user = User::create([
            'name' => $campos['name'],
            'lastname' => $campos['lastname'],
            'email' => $campos['email'],
            'dni' => $campos['dni'],
            'dni_type' => $campos['dni_type'],
            'cel' => $campos['celular'],
            'password'=> bcrypt($campos['password']),
            'role_id' => $request['role_id'] ? $request['role_id'] : 2,
        ]);

        if(!$request['role_id']){
            $user->patient()->create(['o_s_id' => $campos['o_s_id']]);
        }

        return $this->onMessage(201,"Usuario creado de manera correcta");

    }

    public function login (Request $request){
        
        $campos = $request->validate([
            'email' => ['required','string'],
            'password'=> ['required','string']
        ]);

        $user = User::where('email', $campos['email'])->first();

        if(!$user || !Hash::check($campos['password'], $user->password)){

            return $this->onError(401,"Usuario o contraseña incorrectas");
        }
        
        $userRole = $user->role->name;

        if($userRole === "admin"){

            $rol = "admin";
            
        }elseif($userRole === "admision"){

            $rol = "admision";

        }elseif($userRole === "profesional"){

            $rol = "profesional";

        }else{

            $rol = "paciente";
        }
        $token = $user->createToken('auth_token',[$rol])->plainTextToken;

        return $this->onLogin($user,$token,"Inicio de sesión correcto",201);

    }

    public function logout(Request $request){
        
        $request->user()->tokens()->delete();

        return $this->onMessage(201,"Sesión cerrada correctamente");

    }
}
