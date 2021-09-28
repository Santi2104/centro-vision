<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'fecha',
        'practice_id',
        'hora_desde',
        'hora_hasta',
        'intervalo',
        'tomado'
    ];

    public $timestamps = false;

    /**
     * Get the profesional that owns the Agenda
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesional()
    {
        return $this->belongsTo(Professional::class,'professional_id');
    }

        /**
     * Get the practica that owns the Turno
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practica()
    {
        return $this->belongsTo(Practice::class,'practice_id');
    }
}
