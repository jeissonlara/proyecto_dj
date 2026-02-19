<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoReserva;
use App\Models\Reserva;
use App\Services\ReservacionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function __construct(protected ReservacionService $reservacionService)
    {
    }

    /**
     * Verifica disponibilidad de DJs para una fecha.
     * FIX BUG-02: ahora excluye estado RECHAZADA en vez de contar solo PENDIENTE.
     */
    public function disponibilidad(string $fecha): JsonResponse
    {
        $disponible = $this->reservacionService->hayDisponibilidad($fecha);

        return response()->json([
            'success' => true,
            'message' => $disponible ? 'Hay DJs disponibles' : 'No hay DJs disponibles',
            'data'    => [
                'disponible' => $disponible,
                'fecha'      => $fecha,
            ],
        ]);
    }

    /**
     * Crear una reserva desde la app móvil.
     */
    public function reservar(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'plan_id'          => 'required|exists:planes,id',
            'fecha_evento'     => 'required|date|after_or_equal:today',
            'direccion_evento' => 'required|string|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'observaciones'    => 'nullable|string|max:1000',
        ]);

        try {
            $result = $this->reservacionService->crearReserva($validated, $request->user()->id);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data'    => null,
            ], 409);
        }

        return response()->json([
            'success' => true,
            'message' => 'Reserva creada exitosamente',
            'data'    => $result['reserva']->load(['plan', 'estado']),
        ], 201);
    }

    /**
     * Listar reservas del usuario autenticado.
     */
    public function listar(Request $request): JsonResponse
    {
        $reservas = Reserva::with(['plan', 'estado'])
            ->where('user_id', $request->user()->id)
            ->orderBy('fecha_evento', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Reservas recuperadas',
            'data'    => $reservas,
        ]);
    }

    /**
     * Cancelar una reserva del usuario autenticado.
     */
    public function cancelar(Request $request, int $id): JsonResponse
    {
        $reserva = Reserva::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$reserva) {
            return response()->json([
                'success' => false,
                'message' => 'Reserva no encontrada o no autorizada',
                'data'    => null,
            ], 404);
        }

        if (in_array($reserva->estado_id, [EstadoReserva::CONFIRMADA, EstadoReserva::FINALIZADA])) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede cancelar una reserva confirmada o finalizada',
                'data'    => null,
            ], 400);
        }

        $reserva->update(['estado_id' => EstadoReserva::RECHAZADA]);

        return response()->json([
            'success' => true,
            'message' => 'Reserva cancelada correctamente',
            'data'    => $reserva->fresh(['plan', 'estado']),
        ]);
    }
}
