<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function searchUserByDni(Request $request){

        $user = User::where('dni', $request['dni'])->get();

        if(!$user->count()){
            return response()->json([
                'message' => 'El usuario no existe'
            ]);
        }

        return response()->json([
            'user' => $user
        ]);

    }

    public function addUserToQueue(Request $request){ //Se debera enviar el ID o DNI

        //

    }
}
