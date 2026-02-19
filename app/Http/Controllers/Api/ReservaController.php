<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\User;

class ReservaController extends Controller
{
    // Ver disponibilidad real por fecha
    public function disponibilidad($fecha)
    {
        $ocupados = Reserva::where('fecha_evento', $fecha)
                    ->where('estado_id', 1)
                    ->count();

        $totalDjs = User::where('role', User::ROLE_DJ)->count();

        $disponible = $ocupados < $totalDjs;

        return response()->json([
            'success' => true,
            'message' => $disponible ? 'Hay DJs disponibles' : 'No hay DJs disponibles',
            'data' => [
                'disponible' => $disponible,
                'fecha' => $fecha
            ]
        ], 200);
    }

    // Crear reserva asignando DJ libre
    public function reservar(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'plan_id' => 'required|exists:planes,id',
            'fecha_evento' => 'required|date|after_or_equal:today',
            'direccion_evento' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'data' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Lógica de asignación de DJ
        $djDisponible = User::where('role', User::ROLE_DJ)
            ->whereDoesntHave('events', function ($q) use ($request) {
                $q->where('fecha_evento', $request->fecha_evento)
                  ->where('estado_id', 1);
            })->first();

        if (!$djDisponible) {
            return response()->json([
                'success' => false,
                'message' => 'No hay DJs disponibles para esta fecha',
                'data' => null
            ], 409);
        }

        // Crear reserva
        $reserva = Reserva::create([
            'user_id' => $user->id,
            'plan_id' => $request->plan_id,
            'dj_id' => $djDisponible->id,
            'fecha_evento' => $request->fecha_evento,
            'direccion_evento' => $request->direccion_evento,
            'estado_id' => 1, // Pendiente
            'observaciones' => $request->observaciones ?? null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reserva creada exitosamente',
            'data' => $reserva
        ], 201);
    }

    // Listar reservas (Solo del usuario autenticado)
    public function listar(Request $request)
    {
        $user = $request->user();
        
        // Si es admin o DJ podría ver más, pero por ahora en la app móvil asumimos vista de cliente
        $reservas = Reserva::with(['plan', 'estado'])
                        ->where('user_id', $user->id)
                        ->orderBy('fecha_evento', 'desc')
                        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Reservas recuperadas',
            'data' => $reservas
        ], 200);
    }

    // Cancelar reserva
    public function cancelar(Request $request, $id)
    {
        $user = $request->user();
        $reserva = Reserva::where('id', $id)->where('user_id', $user->id)->first();

        if (!$reserva) {
            return response()->json([
                'success' => false,
                'message' => 'Reserva no encontrada o no autorizada',
                'data' => null
            ], 404);
        }

        if ($reserva->estado_id == 2 || $reserva->estado_id == 4) { // Confirmada o Completada
             return response()->json([
                'success' => false,
                'message' => 'No se puede cancelar una reserva confirmada o completada',
                'data' => null
            ], 400);
        }

        $reserva->estado_id = 3; // Cancelada
        $reserva->save();

        return response()->json([
            'success' => true,
            'message' => 'Reserva cancelada correctamente',
            'data' => $reserva
        ], 200);
    }
}


