<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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

    public function getNextPatientToQueue(){

        $cola = Cola::where('atendido','==',0)->get()->unique('patient_id');

        return response()->json([
            "data" => ColaResourse::collection($cola)
        ]);

    }

}
