<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Models\Area;
use \App\Models\User;
use \App\Models\Inventario;
use \App\Models\CreacionUsuarios;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CreacionUsuarioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
    })->middleware('can:dashboard')->name('dashboard');

    Route::get('/novedades', function () {
        $areas = Area::all();
        return view('novedades', compact('areas'));
    })->middleware('can:novedades')->name('novedades');

    Route::get('/calendario', function () {
        return view('calendario');
    })->middleware('can:calendario')->name('calendario');



    //-----------RUTAS PARA EL MENU, ESTO LLAMA A LAS VISTAS QUE SE CREAN EN LA CARPETA MENU-----------

    // DATO IMPORTANTE, DONDE ESTA EL ROUTE::GET ESE NOMBRE DE /crear-areas es peronalizable, LO QUE NO SE CAMBIA ES LA RUTA REAL QUE ES EL RETURN VIEW QUE ESE SI ES LA RUTA REAL, AH Y EL NOMBRE QUE SE LE COLOCA EN NAME crearAreas
    Route::get('/crear-areas', function () {
        return view('menu.CrearAreas');
    })->middleware('can:crearAreas')->name('crearAreas');

    Route::get('/crear-inventario', function () {
        return view('menu.CrearInventario');
    })->middleware('can:create')->name('create');

    Route::get('/inventario-equipos', function () {
        $inventarios = Inventario::all();
        return view('menu.inventarioEquipos', compact('inventarios'));
    })->middleware('can:inventarioEquipos')->name('inventarioEquipos');

    Route::get('/usuarios', function () {
        $usuarios = User::all();
        return view('menu.usuarios', compact('usuarios'));
    })->middleware('can:usuarios')->name('usuarios');

    Route::get('/CreacionUsuario', function () {
        return view('menu.CreacionUsuario');
    })->middleware('can:CreacionUsuario')->name('CreacionUsuario');

    Route::get('/dashboardUsuario', function () {
        return view('menu.usuarioFinal');
    })->middleware('can:dashboardUsuario')->name('dashboardUsuario');

    //-----------FIN RUTAS PARA EL MENU-----------



    //-----------RUTAS QUE MANEJAN LOS DATOS COMO LOS METODOS DE CREATE, STORE, SHOW, EDIT, UPDATE, DESTROY, INDEX-----------

    // Rutas para las novedades de las areas
    Route::get('/areas/create', [AreaController::class, 'create'])->middleware('can:areas.create')->name('areas.create');
    Route::post('/areas', [AreaController::class, 'store'])->middleware('can:areas.store')->name('areas.store');
    Route::get('/areas/{id}', [AreaController::class, 'show'])->middleware('can:areas.show')->name('areas.show');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->middleware('can:areas.edit')->name('areas.edit');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->middleware('can:areas.update')->name('areas.update');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->middleware('can:areas.destroy')->name('areas.destroy');
    Route::get('/areas', [AreaController::class, 'index'])->middleware('can:areas.index')->name('areas.index');
    // Fin rutas areas

    // Rutas para el calendario
    Route::get('/api/events', [CalendarEventController::class, 'index']);
    Route::post('/api/events', [CalendarEventController::class, 'store']);
    Route::put('/api/events/{event}', [CalendarEventController::class, 'update']);
    Route::delete('/api/events/{event}', [CalendarEventController::class, 'destroy']);
    // Fin rutas calendario
    // RUTAS INVENTARIO
    Route::get('/inventario/create', [InventarioController::class, 'create'])->middleware('can:inventario.create')->name('inventario.create');
    Route::post('/inventario', [InventarioController::class, 'store'])->middleware('can:inventario.store')->name('inventario.store');
    Route::get('/inventario', [InventarioController::class, 'index'])->middleware('can:inventario.index')->name('inventario.index');
    // FIN RUTAS INVENTARIO

    Route::get('/creacionusuarios', [CreacionUsuarioController::class, 'create'])->middleware('can:creacionusuarios.create')->name('creacionusuarios.create');
    Route::post('/creacionusuarios', [CreacionUsuarioController::class, 'store'])->middleware('can:creacionusuarios.store')->name('creacionusuarios.store');

    // Rutas para roles
    Route::get('/roles', [RoleController::class, 'index'])->middleware('can:roles.index')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->middleware('can:roles.create')->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->middleware('can:roles.store')->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->middleware('can:roles.edit')->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('can:roles.update')->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('can:roles.destroy')->name('roles.destroy');

    // Rutas para usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->middleware('can:usuarios.index')->name('usuarios.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->middleware('can:usuarios.create')->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->middleware('can:usuarios.create')->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->middleware('can:usuarios.edit')->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->middleware('can:usuarios.update')->name('usuarios.update');
    

    //-----------FIN RUTAS QUE MANEJAN LOS DATOS-----------

});

// Proteger el registro para que solo el admin pueda acceder
Route::get('register', function() { abort(403); });
Route::post('register', function() { abort(403); });
