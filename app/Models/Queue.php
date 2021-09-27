<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
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


}
