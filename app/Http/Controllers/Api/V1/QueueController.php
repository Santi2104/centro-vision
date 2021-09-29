<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cola\ColaPacienteResource;
use App\Models\Patient;
use App\Models\Professional;
//use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{

    public function getNextPatientToQueue(){

        $cola = DB::table('colas')->where('atendido','==', 0)->get()->unique('patient_id');
        //Este codigo funciona tal como quiero, hay que buscar alternativas
        return response()->json([
            "data" => $cola
        ]);

    }

}
