<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;


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
        return view('novedades');
    })->name('novedades');

    Route::get('/rondas', function () {
        return view('rondas');
    })->name('rondas');

    // Ruta para crear un área
    Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
    // Ruta para almacenar un área
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');

    // Ruta para mostrar un área
    Route::get('/areas/{id}', [AreaController::class, 'show'])->name('areas.show');

    // Ruta para editar un área
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');

    // Ruta para actualizar un área
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');

    // Ruta para eliminar un área
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    // Ruta para listar todas las áreas
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
});
