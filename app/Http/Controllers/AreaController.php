<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class AreaController extends Controller
{
    public function index()
    {
        try {
            $areas = Area::all();
            return view('areas.index', compact('areas'));
        } catch (\Exception $e) {
            Log::error('Error en AreaController@index: ' . $e->getMessage());
            return back()->with('error', 'Ha ocurrido un error al cargar las áreas.');
        }
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'torre' => 'required|in:1,2,3',
            'piso' => 'required|in:1,2,3,4,5,6,7',
            'descripcion' => 'required|string',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $imagenesPaths = [];
            
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $imagenPath = $imagen->store('areas', 'public');
                    $imagenesPaths[] = $imagenPath;
                }
            }

            Area::create([
                'area' => $request->area,
                'torre' => $request->torre,
                'piso' => $request->piso,
                'descripcion' => $request->descripcion,
                'imagenes' => $imagenesPaths,
                'usuario_reportador' => Auth::user()->name
            ]);

            return redirect()->route('novedades')->with('success', 'Área creada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error en AreaController@store: ' . $e->getMessage());
            return back()->with('error', 'Ha ocurrido un error al crear el área.');
        }
    }

    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'torre' => 'required|string|max:255',
            'piso' => 'required|integer|min:1',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $datos = [
            'area' => $request->area,
            'torre' => $request->torre,
            'piso' => $request->piso,
            'descripcion' => $request->descripcion,
        ];

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($area->imagen && Storage::disk('public')->exists($area->imagen)) {
                Storage::disk('public')->delete($area->imagen);
            }

            // Guardar la nueva imagen
            $imagenPath = $request->file('imagen')->store('areas', 'public');
            $datos['imagen'] = $imagenPath;
        }

        $area->update($datos);

        return redirect()->route('areas.index')->with('success', 'Área actualizada exitosamente');
    }

    public function destroy(Area $area)
    {
        // Eliminar la imagen del almacenamiento si existe
        if ($area->imagen && Storage::disk('public')->exists($area->imagen)) {
            Storage::disk('public')->delete($area->imagen);
        }

        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Área eliminada exitosamente');
    }

    public function show(Area $area)
    {
        return view('areas.show', compact('area'));
    }
} 