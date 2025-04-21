<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creacionusuarios extends Model
{
    use HasFactory;
    protected $fillable = [
        'primerApellido',
        'segundoApellido',
        'nombres',
        'sexo',
        'fechaNacimiento',
        'tipoDocumento',
        'numeroDocumento',
        'origen',
        'regMedico',
        'direccionDomicilio',
        'departamento',
        'ciudad',
        'barrio',
        'email',
        'celular',
        'tipoProfesion',
        'especialidad',
        'tipoVinculacion',
        'cooperativa',
        'sociedad',
        'otroVinculacion',
        'atencionGrupal',
        'serviciosOfrecidos',
    ];
}