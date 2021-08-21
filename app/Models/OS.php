<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OS extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_os',
        'razon_social',
        'nombre_comercial'
    ];

    
}
