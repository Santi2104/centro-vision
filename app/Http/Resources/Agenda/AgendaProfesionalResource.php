<?php

namespace App\Http\Resources\Agenda;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendaProfesionalResource extends JsonResource
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
        ];
    }
}
