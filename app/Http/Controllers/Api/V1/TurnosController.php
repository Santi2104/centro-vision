<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Turno;
use Illuminate\Http\Request;
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
}
