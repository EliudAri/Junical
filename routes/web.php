<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Models\Area;
use \App\Models\User;
use \App\Models\Inventario;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\InventarioController;


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


    //-----------RUTAS PARA EL MENU, ESTO LLAMA A LAS VISTAS QUE SE CREAN EN LA CARPETA MENU-----------

    // DATO IMPORTANTE, DONDE ESTA EL ROUTE::GET ESE NOMBRE DE /crear-areas es peronalizable, LO QUE NO SE CAMBIA ES LA RUTA REAL QUE ES EL RETURN VIEW QUE ESE SI ES LA RUTA REAL, AH Y EL NOMBRE QUE SE LE COLOCA EN NAME crearAreas
    Route::get('/crear-areas', function () {
        return view('menu.CrearAreas');
    })->name('crearAreas');

    Route::get('/crear-inventario', function () {
        return view('menu.CrearInventario');
    })->name('create');

    Route::get('/inventario-equipos', function () {
        $inventarios = Inventario::all();
        return view('menu.inventarioEquipos', compact('inventarios'));
    })->name('inventarioEquipos');

    Route::get('/usuarios', function () {
        $usuarios = User::all();
        return view('menu.usuarios', compact('usuarios'));
    })->name('usuarios');

    //-----------FIN RUTAS PARA EL MENU-----------

    

    //-----------RUTAS QUE MANEJAN LOS DATOS COMO LOS METODOS DE CREATE, STORE, SHOW, EDIT, UPDATE, DESTROY, INDEX-----------

    // Rutas para las novedades de las areas
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    // Fin rutas areas

    // Rutas para el calendario
    Route::get('/api/events', [CalendarEventController::class, 'index']);
    Route::post('/api/events', [CalendarEventController::class, 'store']);
    Route::put('/api/events/{event}', [CalendarEventController::class, 'update']);
    Route::delete('/api/events/{event}', [CalendarEventController::class, 'destroy']);
    // Fin rutas calendario
    // RUTAS INVENTARIO
    Route::get('/inventario/create', [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    // FIN RUTAS INVENTARIO

    //-----------FIN RUTAS QUE MANEJAN LOS DATOS-----------
    
});
