<?php

namespace App\Http\Resources\Paciente;

use App\Http\Resources\Turno\TurnoPacienteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteAdmisionResource extends JsonResource
{

    public static $wrap = 'paciente';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'paciente_id' => $this->patient->id,
            'nombre' => $this->name,
            'apellido' => $this->lastname,
            'dni' => $this->dni,
            'dni_tipo'=> $this->dni_type,
            'nacimiento'=> $this->date,
            'genero'=> $this->gender,
            'direccion'=> $this->address,
            'celular' => $this->cel,
            'telefono_fijo' => $this->tel_par,
            'email' => $this->email,
            'obra_social' => $this->patient->obraSocial->nombre_comercial,
            'turnos' => TurnoPacienteResource::collection($this->turnoPaciente)

        ];
    }
}
