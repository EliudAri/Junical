<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarEventController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::get('/events', [CalendarEventController::class, 'index']);
    Route::post('/events', [CalendarEventController::class, 'store']);
    Route::put('/events/{event}', [CalendarEventController::class, 'update']);
    Route::delete('/events/{event}', [CalendarEventController::class, 'destroy']);
    // Otras rutas API pueden ir aquí
});
