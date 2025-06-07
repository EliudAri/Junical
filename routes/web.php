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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NovedadController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // FUNCION DASHBOARD SEGUN EL ROL DEL USUARIO
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user && $user->hasRole('Administrador')) {
            return view('dashboard');
        } elseif ($user && $user->hasRole('User')) {
            return view('menu.usuarioFinal');
        } else {
            abort(403, 'No tienes acceso a ningún dashboard.');
        }
    })->middleware('can:dashboard')->name('dashboard');

    // RUTA NOVEDADES
    Route::get('/novedades', function () {
        $novedades = \App\Models\Novedad::all();
        return view('novedades', compact('novedades'));
    })->middleware('can:novedades')->name('novedades');

    // RUTA CALENDARIO
    Route::get('/calendario', function () {
        return view('calendario');
    })->middleware('can:calendario')->name('calendario');



    //-----------RUTAS PARA EL MENU, ESTO LLAMA A LAS VISTAS QUE SE CREAN EN LA CARPETA MENU-----------

    // DATO IMPORTANTE, DONDE ESTA EL ROUTE::GET ESE NOMBRE DE /crear-areas es peronalizable, LO QUE NO SE CAMBIA ES LA RUTA REAL QUE ES EL RETURN VIEW QUE ESE SI ES LA RUTA REAL, AH Y EL NOMBRE QUE SE LE COLOCA EN NAME crearAreas
   

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

    Route::get('/crear-novedad', function () {
        return view('menu.CrearNovedad');
    })->middleware('can:crearNovedad')->name('crearNovedad');

    //-----------FIN RUTAS PARA EL MENU-----------



    //-----------RUTAS QUE MANEJAN LOS DATOS COMO LOS METODOS DE CREATE, STORE, SHOW, EDIT, UPDATE, DESTROY, INDEX-----------

    // // Rutas para las novedades de las areas
   

    
    Route::post('/novedades', [NovedadController::class, 'store'])->middleware('can:novedades.store')->name('novedades.store');
    Route::get('/novedades/{novedad}/edit', [NovedadController::class, 'edit'])->middleware('can:novedades.edit')->name('novedades.edit');
    // Route::put('/novedades/{novedad}', [NovedadController::class, 'update'])->middleware('can:novedades.update')->name('novedades.update');
    // Route::delete('/novedades/{novedad}', [NovedadController::class, 'destroy'])->middleware('can:novedades.destroy')->name('novedades.destroy');
    // // Fin rutas areas

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

    // RUTAS CREACION USUARIOS
    Route::post('/creacionusuarios', [CreacionUsuarioController::class, 'store'])->middleware('can:creacionusuarios.store')->name('creacionusuarios.store');
    // FIN RUTAS CREACION USUARIOS
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

    Route::get('/home', [HomeController::class, 'redirect'])->name('home');

});

// Proteger el registro para que solo el admin pueda acceder
Route::get('register', function() { abort(403); });
Route::post('register', function() { abort(403); });
