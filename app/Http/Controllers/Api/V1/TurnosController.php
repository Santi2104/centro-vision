<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Library\apiHelper;
use App\Http\Resources\Paciente\PacienteTurnoResource;
use App\Http\Resources\Turno\TurnoPacienteResource;
use App\Models\Agenda;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TurnosController extends Controller
{

    use apiHelper;

    public function agregarPacienteAlTurno(Request $request){

        if(!$this->isAdmision($request->user())){
            
            return $this->onError(401,"Acceso no autorizado");
        }

        $validador = Validator::make($request->all(),[
            'agenda_id' => ['required'],
            'patient_id' => ['required'],
            'o_s_id' => ['required'],
        ]);

        if($validador->fails()){
            return response()->json([
                'status' => 200,
                'message' => $validador->errors()
            ]);
        }

        $turno = Turno::create([
            'agenda_id' => $request['agenda_id'],
            'patient_id' => $request['patient_id'],
            'orden' => Str::uuid(),
            'observaciones' => $request['observaciones'],
            'o_s_id' => $request['o_s_id'],
        ]);

        $agenda = Agenda::find($request['agenda_id'], ['id','tomado']);
        $agenda->tomado = true;//debe haber una forma mejor de hacer esto
        $agenda->save();

        return $this->onSuccess(new TurnoPacienteResource($turno),"El turno fue creado de manera correcta",201);

    }

    public function buscarTurnoPaciente(Request $request){

        $validador = Validator::make($request->all(),[
            'dni' => ['required']
        ]);

        if($validador->fails()){
            return response()->json([
                'status' => 200, //Deberia cambiar el trait para poder usarlo en esta parte
                'message' => $validador->errors()
            ]);
        }

        $turnos = User::where('dni',$request['dni'])->first();

        if(is_null($turnos)){

            return $this->onError(200,"No se encontro un usuario con el DNI especificado");
        }

        return $this->onSuccess(new PacienteTurnoResource($turnos),"Usuario encontrado");

    }
}
