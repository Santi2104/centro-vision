<?php

namespace App\Http\Resources\Paciente;

use App\Http\Resources\Turno\TurnoPacienteResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteTurnoResource extends JsonResource
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
            'id' => $this->id,
            'nombre' => $this->name,
            'apellido' => $this->lastname,
            'dni' => $this->dni,
            'turnos' => TurnoPacienteResource::collection($this->turnoPaciente)
        ];
    }
}
