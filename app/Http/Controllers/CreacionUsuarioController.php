<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creacionusuarios;

class CreacionUsuarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'primerApellido' => 'required|string|max:255',
        'segundoApellido' => 'required|string|max:255',
        'nombres' => 'required|string|max:255',
        'sexo' => 'required|string',
        'fechaNacimiento' => 'required|date',
        'tipoDocumento' => 'required|string|max:255',
        'numeroDocumento' => 'required|string|max:255|unique:creacionusuarios',
        'origen' => 'required|string|max:255',
        'regMedico' => 'required|string|max:255',
        'direccionDomicilio' => 'required|string|max:255',
        'departamento' => 'required|string|max:255',
        'ciudad' => 'required|string|max:255',
        'barrio' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:creacionusuarios',
        'celular' => 'required|string|max:255|unique:creacionusuarios',
        'tipoProfesion' => 'required|string|max:255',
        'especialidad' => 'nullable|string|max:255',
        'tipoVinculacion' => 'required|string|max:255',
        'cooperativa' => 'nullable|string|max:255',
        'sociedad' => 'nullable|string|max:255',
        'otroVinculacion' => 'nullable|string|max:255',
        'atencionGrupal' => 'required|string',
        'serviciosOfrecidos' => 'nullable|string',
    ], [
        'primerApellido.required' => 'El campo Primer Apellido es obligatorio.',
        'segundoApellido.required' => 'El campo Segundo Apellido es obligatorio.',
        'numeroDocumento.unique' => 'El número de documento ya existe.',
        'email.unique' => 'El email ya existe.',
        'celular.unique' => 'El celular ya existe.',
    ]);
        Creacionusuarios::create($request->all());
        return redirect()->back()->with('success', 'Usuario creado exitosamente.');
    }
}
