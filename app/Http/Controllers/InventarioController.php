<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function create()
    {
        return view('inventario.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'tipo_equipo' => 'required',
            'pertenece' => 'required',
            'serial_cpu' => 'required|unique:inventarios',
            'serial_monitor' => 'required|unique:inventarios',
            'serial_mac' => 'required|unique:inventarios',
            'serial_fisico_monitor' => 'required',
            'capacidad_disco' => 'required',
            'tipo_disco' => 'required',
            'capacidad_ram' => 'required',
            'tipo_procesador' => 'required',
            'marca_monitor' => 'required',
            'area' => 'required',
            'jefe_area' => 'required',
            'torre' => 'required',
            'ip_equipo' => 'required|unique:inventarios',
            'sistema_operativo' => 'required',
            'version_office' => 'required',
            'tipo_antivirus' => 'required|in:ninguno,Eset Nod32',
            'perifericos' => 'required',
        ], [
            'serial_cpu.unique' => 'El serial CPU ya existe.',
            'serial_monitor.unique' => 'El serial Monitor ya existe.',
            'serial_mac.unique' => 'El serial MAC ya existe.',
            'ip_equipo.unique' => 'La IP del equipo ya existe.',
        ]);

        // Verificar si hay errores de validación
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Mantiene los datos ingresados
        }

        Inventario::create($request->all());

        return redirect()->route('inventarioEquipos')->with('success', 'Equipo inventariado correctamente.');
    }

    public function index(Request $request)
    {
        $query = Inventario::query();

        // Verificar si hay un término de búsqueda
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tipo_equipo', 'LIKE', "%{$search}%")
                  ->orWhere('pertenece', 'LIKE', "%{$search}%")
                  ->orWhere('serial_cpu', 'LIKE', "%{$search}%")
                  ->orWhere('serial_monitor', 'LIKE', "%{$search}%")
                  ->orWhere('serial_mac', 'LIKE', "%{$search}%")
                  ->orWhere('serial_fisico_monitor', 'LIKE', "%{$search}%")
                  ->orWhere('area', 'LIKE', "%{$search}%")
                  ->orWhere('jefe_area', 'LIKE', "%{$search}%")
                  ->orWhere('torre', 'LIKE', "%{$search}%")
                  ->orWhere('ip_equipo', 'LIKE', "%{$search}%");
            });
        }

        $inventarios = $query->get();

        return view('inventario.inventarioEquipos', compact('inventarios'));
    }

    // Agrega otros métodos como index, edit, update, destroy según sea necesario
} 