<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'description'
    ];

    /**
     * Get the practiceGroup that owns the Practice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practiceGroup()
    {
        return $this->belongsTo(PracticeGroup::class);
    }

    /**
     * The profesionales that belong to the Practice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profesionales()
    {
        return $this->belongsToMany(Professional::class, 'practica_profesionales');
    }
}
