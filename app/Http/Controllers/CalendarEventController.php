<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class CalendarEventController extends Controller
{
    public function index()
    {
        try {
            $events = CalendarEvent::all();
            Log::info('Datos recibidos...', $events->toArray());

            return response()->json($events->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start->toISOString(),
                    'end' => $event->end->toISOString(),
                    'color' => $event->color,
                    'repeat_type' => $event->repeat_type,
                    'repeat_days' => $event->repeat_days
                ];
            }));
        } catch (\Exception $e) {
            Log::error('Error al cargar eventos: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('Datos recibidos:', $request->all());

            $validated = $request->validate([
                'title' => 'required|string',
                'start' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end' => 'required|date',
                'end_time' => 'required|date_format:H:i',
                'color' => 'required|string',
                'repeat_type' => 'nullable|string',
                'repeat_days' => 'nullable'
            ]);

            $event = CalendarEvent::create($validated);

            return response()->json($event, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear evento: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al crear el evento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, CalendarEvent $event)
    {
        try {
            $validated = $request->validate([
                'start' => 'sometimes|date',
                'end' => 'sometimes|date',
                'title' => 'sometimes|string',
                'color' => 'sometimes|string',
                'start_time' => 'sometimes|date_format:H:i',
                'end_time' => 'sometimes|date_format:H:i',
            ]);

            $event->update($validated);
            return response()->json($event);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(CalendarEvent $event)
    {
        try {
            $event->delete();
            return response()->json(['message' => 'Evento eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
