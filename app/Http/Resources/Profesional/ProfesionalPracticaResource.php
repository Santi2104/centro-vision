<?php

namespace App\Http\Resources\Profesional;

use App\Http\Resources\Agenda\AgendaProfesionalResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfesionalPracticaResource extends JsonResource
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
            'user_id' => $this->user->id,
            'nombre' => $this->user->name,
            'apellido' => $this->user->lastname,
            'practicas' => $this->practicas,
            'agenda' => AgendaProfesionalResource::collection($this->agendas)
        ];
    }
}
