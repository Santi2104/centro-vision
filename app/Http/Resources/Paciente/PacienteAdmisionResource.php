<?php

namespace App\Http\Resources\Paciente;

use Illuminate\Http\Resources\Json\JsonResource;

class PacienteAdmisionResource extends JsonResource
{
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
            'apellido'=> $this->lastname,
            'dni'=> $this->dni,
            'dni_tipo'=> $this->dni_type,
            'nacimiento'=> $this->date,
            'genero'=> $this->gender,
            'direccion'=> $this->address,
            'paciente' => $this->patient

        ];
    }
}
