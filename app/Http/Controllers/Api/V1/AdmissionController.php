<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Library\apiHelper;
use App\Http\Resources\Paciente\PacienteAdmisionResource;
use App\Http\Resources\Profesional\ProfesionalPracticaResource;
use App\Models\Admission;
use App\Models\OS;
use App\Models\Professional;
use App\Models\Cola;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{

    use apiHelper;

    public function getUserByDni(Request $request){

        if(!$this->isAdmision($request->user())){
            
            return $this->onError(401,"Acceso no autorizado");
        }

        $validator = Validator::make($request->all(),[
            'dni' => ['required','numeric'] //Buscar la forma de validar que llegue un numero, esyo no funciona
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 200,
                'message' => $validator->errors()
            ]);
        }

        $user = User::where('dni', $request['dni'])->first();

        if(is_null($user)){

            return $this->onError(200,"El usuario con el DNI solicitado no fue encontrado");
        }
        //en este punto, verificar si el usuario selecionado es paciente
        return $this->onSuccess(new PacienteAdmisionResource($user),"Usuario encontrado");

    }

    public function getAdmisionData(){

        $profesionales = Professional::all(['id','user_id']);

        $os = OS::all(['id','nombre_comercial','codigo_os']); 

        return $this->onSuccess(
            [
                "profesionales" => ProfesionalPracticaResource::collection($profesionales),
                "obra_social" => $os
            ]
            );

    }

    public function ingresoPaciente(Request $request){

        if(!$this->isAdmision($request->user())){
            
            return $this->onError(401,"Acceso no autorizado");
        }

        $validator = Validator::make($request->all(),[
            'o_s' => ['required'],
            'professional_id' => ['required'],
            'patient_id' => ['required'],
            'practice_id' => ['required'],
            'importe' => ['required'],
            'alta' => ['required'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 200,
                'message' => $validator->errors()
            ]);
        }


        Admission::create([
            'date' => Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString(),
            'user_id' => Auth::id(),
            'o_s_id' => $request['o_s'],
            'professional_id' => $request['professional_id'],
            'patient_id' => $request['patient_id'],
            'practice_id' => $request['practice_id'],
            'importe' => $request['importe'],
            'notes' => $request['notas'],
            'nro_comprobante' => $request['nro_comprobante']
        ]);

        Cola::create([
            'professional_id' => $request['professional_id'],
            'patient_id' => $request['patient_id'],
            'alta' => $request['alta'],
        ]);

        return $this->onMessage(201,"Admision de paciente cargada de manera satisfactoria");

    }


}
