<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Library\apiHelper;
use App\Http\Resources\Cola\ColaPacienteResource;
use App\Http\Resources\Cola\ColaResourse;
use App\Models\Cola;
use App\Models\Patient;
use App\Models\Professional;
//use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    use apiHelper;

    public function getNextPatientToQueue(Request $request){

        if(!$this->isAdmision($request->user())){
            
            return $this->onError(401,"Acceso no autorizado");
        }

        $cola = Cola::where('atendido','==',0)->get()->unique('patient_id');

        return response()->json([
            "data" => ColaResourse::collection($cola)
        ]);

    }

    public function llamarProximoPaciente(Request $request){

        $cola = Cola::find($request['id_cola'],['id','llamando']);
        $cola->llamando = true;
        $cola->save();
        return $cola;

    }

}
