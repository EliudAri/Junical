<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Models\Area;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/novedades', function () {
        $areas = Area::all();
        return view('novedades', compact('areas'));
    })->name('novedades');

    Route::get('/rondas', function () {
        return view('rondas');
    })->name('rondas');
// DATO IMPORTANTE DONDE ESTA EL ROUTE::GET ESE NOMBRE DE /crear-areas es peronalizable, LO QUE NO SE CAMBIA ES LA RUTA REAL QUE ES EL RETURN VIEW QUE ESE SI ES LA RUTA REAL, AH Y EL NOMBRE QUE SE LE COLOCA EN NAME crearAreas
    Route::get('/crear-areas', function () {
        return view('menu.CrearAreas');
    })->name('crearAreas');

    // Rutas para las novedades de las areas
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    // Fin rutas areas

    
});
