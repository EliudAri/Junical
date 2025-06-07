<?php

namespace App\Http\Controllers;

use App\Models\Novedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class NovedadController extends Controller
{
    public function index()
    {
        try {
            $novedades = Novedad::all();
            return view('novedades.index', compact('novedades'));
        } catch (\Exception $e) {
            Log::error('Error en NovedadController@index: ' . $e->getMessage());
            return back()->with('error', 'Ha ocurrido un error al cargar las novedades.');
        }
    }

    public function create()
    {
        return view('novedades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'torre' => 'required|in:1,2,3',
            'piso' => 'required|in:s1,s2,ss,1,2,3,4,5,6,7',
            'descripcion' => 'required|string',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $imagenesPaths = [];
            
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    $imagenPath = $imagen->store('novedades', 'public');
                    $imagenesPaths[] = $imagenPath;
                }
            }

            Novedad::create([
                'area' => $request->area,
                'torre' => $request->torre,
                'piso' => $request->piso,
                'descripcion' => $request->descripcion,
                'imagenes' => $imagenesPaths,
                'usuario_reportador' => Auth::user()->name
            ]);

            return redirect()->route('novedades.index')->with('success', 'Novedad creada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error en NovedadController@store: ' . $e->getMessage());
            return back()->with('error', 'Ha ocurrido un error al crear la novedad.');
        }
    }

    public function edit(Novedad $novedad)
    {
        return view('novedades.edit', compact('novedad'));
    }

    public function update(Request $request, Novedad $novedad)
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
            if ($novedad->imagen && Storage::disk('public')->exists($novedad->imagen)) {
                Storage::disk('public')->delete($novedad->imagen);
            }

            // Guardar la nueva imagen
            $imagenPath = $request->file('imagen')->store('novedades', 'public');
            $datos['imagen'] = $imagenPath;
        }

        $novedad->update($datos);

        return redirect()->route('novedades.index')->with('success', 'Novedad actualizada exitosamente');
    }

    public function destroy(Novedad $novedad)
    {
        // Eliminar la imagen del almacenamiento si existe
        if ($novedad->imagen && Storage::disk('public')->exists($novedad->imagen)) {
            Storage::disk('public')->delete($novedad->imagen);
        }

        $novedad->delete();

        return redirect()->route('novedades.index')->with('success', 'Novedad eliminada exitosamente');
    }

    public function show(Novedad $novedad)
    {
        return view('novedades.show', compact('novedad'));
    }
} 