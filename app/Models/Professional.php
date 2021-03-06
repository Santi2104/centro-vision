<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'matricula_prov',
        'matricula_nac',
        'especialidad',
        'suspended'
    ];

    /**
     * Get the user that owns the Professional
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the queues for the Professional
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    /**
     * Get all of the agendas for the Professional
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    /**
     * The practicas that belong to the Professional
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function practicas()
    {
        return $this->belongsToMany(Practice::class,'practica_profesionales');
    }
}
