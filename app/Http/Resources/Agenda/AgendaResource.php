<?php

namespace App\Http\Resources\Agenda;

use App\Http\Resources\Profesional\ProfesionalTurnoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
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
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'profesional' => new ProfesionalTurnoResource($this->profesional->user)
        ];
    }
}
