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
}
