<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cola extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'professional_id',
        'alta',
        'llamando',
        'atendido'
    ];

    //public $timestamps = false;

    /**
     * Get the pacientes that owns the Cola
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paciente()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    /**
     * Get the profesionales that owns the Cola
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesional()
    {
        return $this->belongsTo(Professional::class,'professional_id');
    }


}
