<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Library\apiHelper;
use App\Models\Agenda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{

    use apiHelper;

    public function addAgendaToProfessional(Request $request){

        if(!$this->isAdmision($request->user())){
            
            return $this->onError(401,"Acceso no autorizado");
        }

        $allAdmisionData = [];
        $datosAComprobar = [];

        $validador = Validator::make($request->all(),[
            'professional_id' => ['required'],
            'practice_id' => ['required'],
            'fecha' => ['required'],
            'hora_inicio' => ['required'],
            'hora_fin' => ['required'],
            'intervalo' => ['required'],
        ]);

        if($validador->fails()){

            return response()->json([
                'status' => 200,
                'message' => $validador->errors(),
            ], 200);

        }

        //Primero: Creo en formato Carbon la fecha y hora de inicio y las guardo
        //DNI, fecha de nacimiento, obra social,sexo,profesional,tratamiento,telefono,email
        $horaInicio = Carbon::createFromFormat('H:i', $request->hora_inicio);
        $horaFin = Carbon::createFromFormat('H:i',$request->hora_fin);


        if($horaInicio->greaterThan($horaFin)){
            return $this->onError(200,"La hora de inicio no puede ser mayor que la fecha de fin");
        }

        $horaInicio = $horaInicio->toTimeString();
        $horaFin = $horaFin->toTimeString();
        $dia = Carbon::createFromDate($request->fecha)->toDateString();

        $colas = Agenda::where([
            ['professional_id', "=", $request['professional_id']],
            ["fecha", "=", $dia],
        ])->get();    
  
        $tiempoBase = Carbon::create("$dia". " $horaInicio");
        $tiempoLimite = Carbon::create("$dia". " $horaFin");

        //Segundo: con los anteriores datos creo el periodo y los convierto en array
        $intervalos = CarbonPeriod::create($tiempoBase, $request->intervalo.' minutes',$tiempoLimite, CarbonPeriod::EXCLUDE_END_DATE);

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
        //Validar en este punto si ya existe una agenda para ese dia y esa hora

        foreach($allAdmisionData as $index => $valor[]){

            foreach($colas as $cola){

                if($cola->hora == $valor[$index]["hora"]->toTimeString()){

                    $datosAComprobar[] = $valor[$index]["hora"]->toDateTimeString();
                }
            }
        }

        if(count($datosAComprobar)){

            return $this->onError(200,"El profesional ya tiene turnos asignados en los horarios elegidos",$datosAComprobar);
        }

        Agenda::insert($allAdmisionData);
        //*TODO: mandar en la resputar la agenda recien creada
        return $this->onMessage(201,'Agenda creada de manera satisfactoria');
        

    }
}
