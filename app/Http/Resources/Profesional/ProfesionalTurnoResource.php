<?php

namespace App\Http\Resources\Profesional;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfesionalTurnoResource extends JsonResource
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
            'id' => $this->profesional->id,
            'user_id' => $this->id,
            'nombre' => $this->name,
            'apellido' => $this->lastname
        ];
    }
}
