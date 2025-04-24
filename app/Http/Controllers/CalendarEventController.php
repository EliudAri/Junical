<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class CalendarEventController extends Controller
{
    public function index()
    {
        try {
            $events = CalendarEvent::all();
            
            return response()->json($events->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start->format('Y-m-d'),
                    'end' => $event->end->format('Y-m-d'),
                    'start_time' => $event->start_time ? $event->start_time->format('h:i A') : '12:00 AM',
                    'end_time' => $event->end_time ? $event->end_time->format('h:i A') : '12:00 AM',
                    'color' => $event->color
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
            $validated = $request->validate([
                'title' => 'required|string',
                'start' => 'required|date',
                'start_time' => 'required',
                'end' => 'required|date',
                'end_time' => 'required',
                'color' => 'required|string'
            ]);

            $event = CalendarEvent::create($validated);

            return response()->json([
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start . ' ' . $event->start_time,
                'end' => $event->end . ' ' . $event->end_time,
                'color' => $event->color,
                'allDay' => false
            ], 201);
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
                'start_time' => 'sometimes',
                'end_time' => 'sometimes'
            ]);

            $event->update($validated);

            return response()->json([
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start . ' ' . $event->start_time,
                'end' => $event->end . ' ' . $event->end_time,
                'color' => $event->color,
                'allDay' => false
            ]);
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
