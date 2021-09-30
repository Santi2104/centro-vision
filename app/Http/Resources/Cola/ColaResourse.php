<?php

namespace App\Http\Resources\Cola;

use Illuminate\Http\Resources\Json\JsonResource;

class ColaResourse extends JsonResource
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
            'alta' => $this->alta,
            'paciente' => $this->paciente->user->name . ' ' . $this->paciente->user->lastname,
            'profesional' => $this->profesional->user->name . ' ' . $this->profesional->user->lastname,
            'llamando' => $this->llamando,
            'atendido' => $this->atendido
        ];
    }
}
