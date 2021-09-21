<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Paciente\PacienteTurnoResource;
use App\Models\Agenda;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TurnosController extends Controller
{
    public function agregarPacienteAlTurno(Request $request){

        $turno = Turno::create([
            'agenda_id' => $request['agenda_id'],
            'patient_id' => $request['patient_id'],
            'orden' => Str::uuid(),
            'observaciones' => $request['observaciones'],
            'practice_id' => $request['practice_id'],
        ]);

        $agenda = Agenda::find($request['agenda_id'], ['id','tomado']);
        $agenda->tomado = true;//debe haber una forma mejor de hacer esto
        $agenda->save();

        return response()->json([
            'message' => "El turno fue creado de manera correcta",
            'turno' => $turno,
        ]);

    }

    public function buscarTurnoPaciente(Request $request){

        $validador = Validator::make($request->all(),[
            'dni' => ['required']
        ]);

        if($validador->fails()){
            return response()->json([
                'errores' => $validador->errors()
            ]);
        }

        $turnos = User::where('dni',$request['dni'])->first();

        if($turnos == null){
            return response()->json([
                'mensaje' => 'Paciente no encontrado'
            ]);
        }

        return new PacienteTurnoResource($turnos);

    }
}
