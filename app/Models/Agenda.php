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
}
