<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\EstadoReserva;
use App\Models\Plan;
use App\Models\Reserva;
use App\Models\User;
use App\Services\AlertService;
use App\Services\ReservacionService;

class ReservationController extends Controller
{
    public function __construct(protected ReservacionService $reservacionService)
    {
    }

    // ─────────────────────────────────────────────────────────────────────────
    // SHARED (Admin y Client)
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Admin: lista todas las reservas.
     * Client: lista solo las del usuario autenticado.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $reservations = Reserva::with(['user', 'plan', 'estado', 'dj'])->latest()->get();
            $djs          = User::where('role', User::ROLE_DJ)->get();
            return view('admin.reservations.index', compact('reservations', 'djs'));
        }

        // Vista cliente
        $reservations = $user->reservas()->with(['plan', 'estado'])->latest()->get();
        return view('client.reservations.index', compact('reservations'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // CLIENT – Crear reserva
    // ─────────────────────────────────────────────────────────────────────────

    public function create()
    {
        $plans = Plan::with('equipos')->get();
        return view('client.reservations.create', compact('plans'));
    }

    public function store(StoreReservationRequest $request)
    {
        try {
            $result = $this->reservacionService->crearReserva(
                $request->validated(),
                auth()->id()
            );
        } catch (\RuntimeException $e) {
            AlertService::error('Error', $e->getMessage());
            return back();
        }

        // Feedback inteligente post-creación
        if ($result['isRush']) {
            AlertService::warning(
                'Evento Relámpago Detectado',
                'Tu reserva es en menos de 48h. Un coordinador te contactará de inmediato para logística urgente.'
            );
        } elseif ($result['isSaturated']) {
            AlertService::info(
                'Alta Demanda',
                'Has asegurado uno de los últimos cupos para esta fecha. ¡Excelente elección!'
            );
        } else {
            AlertService::success(
                'Solicitud Enviada',
                'Tu reserva está PENDIENTE. El administrador revisará tu evento.'
            );
        }

        return redirect()->route('dashboard');
    }

    /**
     * Detalle de una reserva (vista cliente).
     */
    public function show(Reserva $reservation)
    {
        $this->authorize('view', $reservation);
        return view('client.reservations.show', ['reserva' => $reservation->load(['plan', 'estado', 'dj'])]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // DJ – Mis eventos
    // ─────────────────────────────────────────────────────────────────────────

    public function myEvents()
    {
        $events = auth()->user()->events()->with(['user', 'plan', 'estado'])->latest()->get();
        return view('dj.events', compact('events'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // ADMIN – Gestión de estado, asignación y cierre
    // ─────────────────────────────────────────────────────────────────────────

    public function updateStatus(\Illuminate\Http\Request $request, Reserva $reserva)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados_reserva,id',
        ]);

        $newStatus = (int) $request->estado_id;

        if ($newStatus === EstadoReserva::CONFIRMADA) {
            // Verificar conflicto de DJ para reservas confirmadas
            if ($this->reservacionService->hayConflictoConfirmado($reserva->dj_id, $reserva->fecha_evento, $reserva->id)) {
                AlertService::error('Conflicto DJ', 'El DJ asignado ya tiene una reserva confirmada para esta fecha.');
                return back();
            }

            // Verificar stock de equipo
            $equipoSinStock = $this->reservacionService->verificarStockParaConfirmacion($reserva);
            if ($equipoSinStock) {
                AlertService::error('Stock Insuficiente', "No hay suficientes unidades de {$equipoSinStock} para esta fecha.");
                return back();
            }
        }

        $reserva->update(['estado_id' => $newStatus]);

        match ($newStatus) {
            EstadoReserva::CONFIRMADA => AlertService::success('Reserva Confirmada', 'El evento ha sido aprobado y el equipo asignado.'),
            EstadoReserva::RECHAZADA  => AlertService::warning('Reserva Rechazada', 'El evento ha sido cancelado y el horario liberado.'),
            default                   => AlertService::info('Estado Actualizado', 'El estado de la reserva ha cambiado.'),
        };

        return back();
    }

    public function assignDj(\Illuminate\Http\Request $request, Reserva $reserva)
    {
        $request->validate([
            'dj_id' => 'required|exists:users,id',
        ]);

        $reserva->update(['dj_id' => $request->dj_id]);

        AlertService::success('DJ Reasignado', 'El personal técnico ha sido actualizado correctamente.');
        return back();
    }

    /**
     * Finalizar una reserva (solo confirmadas).
     */
    public function finalize(Reserva $reserva)
    {
        if (!$reserva->isConfirmed()) {
            AlertService::error('Acción Inválida', 'Solo se pueden finalizar reservas que estén Confirmadas.');
            return back();
        }

        $reserva->update(['estado_id' => EstadoReserva::FINALIZADA]);

        AlertService::success('Evento Finalizado', 'El servicio ha concluido exitosamente.');
        return back();
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        AlertService::warning('Reserva Eliminada', 'La reserva ha sido rechazada y eliminada del sistema.');
        return back();
    }
}
