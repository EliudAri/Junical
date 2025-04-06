<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_equipo',
        'pertenece',
        'serial_cpu',
        'serial_monitor',
        'serial_mac',
        'serial_fisico_monitor',
        'capacidad_disco',
        'tipo_disco',
        'capacidad_ram',
        'tipo_procesador',
        'marca_monitor',
        'area',
        'jefe_area',
        'torre',
        'ip_equipo',
        'sistema_operativo',
        'version_office',
        'tipo_antivirus',
        'perifericos',
        'marca_teclado',
        'marca_mouse',
    ];
} 