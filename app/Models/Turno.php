<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_id',
        'patient_id',
        'orden',
        'observaciones',
        'practice_id',
        'cancelado',
        'cumplido',
        'o_s_id'
    ];

    /**
     * Get the agenda that owns the Turno
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
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

    /**
     * Get the obraSocial that owns the Turno
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function obraSocial()
    {
        return $this->belongsTo(OS::class,'os_id');
    }

    
}
