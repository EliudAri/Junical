<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $table = 'novedades';

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
