<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\OS;
use App\Models\Practice;
use App\Models\Professional;
use App\Models\Queue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{
    public function getUserByDni(Request $request){

        $validator = Validator::make($request->all(),[
            'dni' => ['required','numeric'] //Buscar la forma de validar que llegue un numero, esyo no funciona
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $user = User::with([
            'patient' => function($query){
                $query->select('id','ob','plan','user_id');
            }
        ])->where('dni', $request['dni'])
          ->get();

        if(!$user->count()){
            return response()->json([//Mandar las practicas
                'message' => 'El usuario no existe'
            ]);
        }

        return response()->json([
            'user' => $user
        ]);

    }

    public function addUserToQueue(Request $request){ //Se debera enviar el ID o DNI

        $colas = $request->cola;
        $admisiones = $request->admision;
        $allDataCola = [];
        $allDataAdmision = [];

        //Perfecto!!!!
        $validator = Validator::make($request->all(), [
            'cola.*.professional_id' => 'required',
            'cola.*.patient_id' => 'required',
            'cola.*.alta' => 'required',
            'admision.*.professional_id' => 'required',
            'admision.*.patient_id' => 'required',
            'admision.*.importe' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "datas" => $validator->errors()
            ]);
        }

        try{//Creo que cada insercion debe ir en su propio try catch
            foreach($colas as $item){

                $cola = new Queue();
                $cola->professional_id = $item['professional_id'];
                $cola->patient_id = $item['patient_id'];
                $cola->alta = Carbon::createFromTimeString($item['alta'])->toTimeString();
                $cola->created_at = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
                $cola->updated_at = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
                $allDataCola[] = $cola->attributesToArray();
            }
    
            Queue::insert($allDataCola);
    
            foreach($admisiones as $item){
    
                $admision = new Admission();
                $admision->professional_id = $item['professional_id'];
                $admision->patient_id = $item['patient_id'];
                $admision->importe = $item['importe'];
                $admision->notes = $item['notes'];
                $admision->user_id = $item['user_id'];
                $admision->date = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
                $admision->o_s = 1;
                $admision->practice_id = 1;
                $cola->created_at = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
                $cola->updated_at = Carbon::now('America/Argentina/La_Rioja')->toDateTimeLocalString();
                $allDataAdmision[] = $admision->attributesToArray();
    
            }
    
            Admission::insert($allDataAdmision);
        }catch(QueryException $e){
            return response()->json(array('message' =>$e->getMessage()));
        }
        //dd($allDataCola);
        return response()->json(["message" => "El usuario se agrego a admision de manera correcta"]);

    }

    public function getAdmisionData(){
        //El nombre talves cambie a getAdmisionData
        $profesionales = Professional::with([
            'user' => function($query){
                $query->select('id','name','lastname');
            }
        ])->get(['id','user_id']);

        $practicas = Practice::with([
            'practiceGroup' => function($query){
                $query->select('id','cod');
            }
        ])->get(['id', 'cod', 'description','practice_group_id']);

        $os = OS::all(['id','nombre_comercial','codigo_os']); 

        return response()->json([
            "data" => [
                "profesionales" => $profesionales,
                "practicas" => $practicas,
                "obra_social" => $os
            ]
        ]);

    }


}
