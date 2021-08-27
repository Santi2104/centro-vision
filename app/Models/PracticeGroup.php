<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'description'
    ];

    /**
     * Get all of the practices for the PracticeGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function practices()
    {
        return $this->hasMany(Practice::class);
    }
}
