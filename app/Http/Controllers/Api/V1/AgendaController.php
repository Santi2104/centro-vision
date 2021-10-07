<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Library\apiHelper;
use App\Models\Agenda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

    use apiHelper;

    public function addAgendaToProfessional(Request $request){

        $allAdmisionData = [];
        //Primero: Creo en formato Carbon la fecha y hora de inicio y las guardo
        //DNI, fecha de nacimiento, obra social,sexo,profesional,tratamiento,telefono,email
        $horaInicio = Carbon::createFromFormat('H:i', $request->hora_inicio)->toTimeString();
        $horaFin = Carbon::createFromFormat('H:i',$request->hora_fin)->toTimeString();
        $dia = Carbon::createFromDate($request->fecha)->toDateString();
        
        $tiempoBase = Carbon::create("$dia". " $horaInicio");
        $tiempoLimite = Carbon::create("$dia". " $horaFin");

        //Segundo: con los anteriores datos creo el periodo y los convierto en array
        $intervalos = CarbonPeriod::create($tiempoBase, $request->intervalo.' minutes',$tiempoLimite, CarbonPeriod::EXCLUDE_END_DATE);
        $intervalos->toArray();


        //Tercero: Itero el array que cree antes, y por cada interacion guardo una nueva instancia de la Agenda
        foreach($intervalos as $intervalo){
            $agenda = new Agenda();
            $agenda->professional_id = $request['professional_id'];
            $agenda->practice_id = $request['practice_id'];
            $agenda->fecha = $dia;
            $agenda->hora = $intervalo;
            $agenda->intervalo = $request['intervalo'];
            $agenda->created_at = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
            $agenda->updated_at = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
            $allAdmisionData[] = $agenda->attributesToArray();
        }
        //Cuarto: Insertamos los valores que creamos antes en la tabla agenda
        Agenda::insert($allAdmisionData);

        return $this->onMessage(201,'Agenda creada de manera satisfactoria');
        

    }
}
