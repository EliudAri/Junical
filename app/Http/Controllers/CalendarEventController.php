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
            Log::info('Datos recibidos...', $events->toArray());

            return response()->json($events->map(function ($event) {
                $endDate = Carbon::parse($event->end)->endOfDay();
                
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => Carbon::parse($event->start)->startOfDay()->toISOString(),
                    'end' => $endDate->toISOString(),
                    'color' => $event->color,
                    'display' => 'background',
                    'allDay' => true
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
                'color' => 'required|string'
            ]);

            $event = CalendarEvent::create($validated);

            return response()->json([
                'id' => $event->id,
                'title' => $event->title,
                'start' => Carbon::parse($event->start)->startOfDay()->toISOString(),
                'end' => Carbon::parse($event->end)->startOfDay()->toISOString(),
                'color' => $event->color,
                'display' => 'background',
                'allDay' => true
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
                'start_time' => 'sometimes|date_format:H:i',
                'end_time' => 'sometimes|date_format:H:i'
            ]);

            if (isset($validated['end'])) {
                $validated['end'] = Carbon::parse($validated['end'])->endOfDay()->format('Y-m-d');
            }

            $event->update($validated);

            return response()->json([
                'id' => $event->id,
                'title' => $event->title,
                'start' => Carbon::parse($event->start)->startOfDay()->toISOString(),
                'end' => Carbon::parse($event->end)->endOfDay()->toISOString(),
                'color' => $event->color,
                'display' => 'background',
                'allDay' => true
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
