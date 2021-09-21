<?php

namespace App\Http\Resources\Turno;

use App\Http\Resources\Agenda\AgendaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TurnoPacienteResource extends JsonResource
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
            'orden' => $this->orden,
            'agenda' => new AgendaResource($this->agenda),
            'observaciones' => $this->observaciones,
            'practica' => $this->practica->description
        ];
    }
}
