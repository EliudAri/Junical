<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'area',
        'torre',
        'piso',
        'descripcion',
        'imagenes',
        'usuario_reportador'
    ];

    protected $casts = [
        'imagenes' => 'array'
    ];
}
