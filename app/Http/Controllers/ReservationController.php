<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $reservations = \App\Models\Reserva::with(['user', 'plan', 'estado', 'dj'])->latest()->get();
            $djs = \App\Models\User::where('role', 'dj')->get();
            return view('admin.reservations.index', compact('reservations', 'djs'));
        }
        // Client view
        $reservations = $user->reservas()->with(['plan', 'estado'])->latest()->get();
        return view('client.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $plans = \App\Models\Plan::with('equipos')->get();
        return view('client.reservations.create', compact('plans'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:planes,id',
            'fecha_evento' => 'required|date|after:today',
            'direccion_evento' => 'required|string|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'observaciones' => 'required|string|max:1000',
        ]);

        $plan = \App\Models\Plan::with('equipos')->find($request->plan_id);
        $date = $request->fecha_evento;
        
        // 🎧 SMART DJ ROTATION LOGIC
        // 1. Get all professionals (role 'dj')
        // 2. Count their active reservations (non-rejected)
        // 3. Sort by: a) Least reservations count, b) Oldest latest event date (tie-break)
        $availableDj = \App\Models\User::where('role', 'dj')
            ->leftJoin('reservas', function($join) {
                $join->on('users.id', '=', 'reservas.dj_id')
                     ->where('reservas.estado_id', '!=', 3); // Exclude Rejected
            })
            ->select('users.*')
            ->selectRaw('COUNT(reservas.id) as events_count')
            ->selectRaw('MAX(reservas.fecha_evento) as last_event_date') // Tie-breaker
            ->groupBy('users.id')
            ->orderBy('events_count', 'asc')
            ->orderBy('last_event_date', 'asc')
            ->first();

        if (!$availableDj) {
            \App\Services\AlertService::error('Error Crítico', 'No hay personal de DJ disponible en el sistema. Contacte a soporte.');
            return back();
        }

        $estadoPendiente = \App\Models\EstadoReserva::where('nombre', 'Pendiente')->first();
        $statusId = $estadoPendiente ? $estadoPendiente->id : 1; 
        
        // --- 🤖 PRO AUTOMATIONS: PRE-FLIGHT CHECKS ---
        
        // 1. Date Saturation Check (High Demand)
        $eventsOnDate = \App\Models\Reserva::where('fecha_evento', $date)->where('estado_id', '!=', 3)->count();
        $saturationWarning = false;
        if ($eventsOnDate >= 2) {
            $saturationWarning = true;
        }

        // 2. Rush Event Check (< 48 Hours)
        $isRushEvent = \Carbon\Carbon::parse($date)->diffInHours(now()) < 48;

        // 3. Double Booking Check (DJ specific)
        $conflict = \App\Models\Reserva::where('dj_id', $availableDj->id)->where('fecha_evento', $date)->where('estado_id', '!=', 3)->exists();
        if ($conflict) {
            \App\Services\AlertService::warning('Conflicto de Agenda', 'El DJ asignado automáticamente tiene un conflicto. Intente otra fecha.');
             return back();
        }

        $reserva = \App\Models\Reserva::create([
            'user_id' => auth()->id(),
            'plan_id' => $plan->id,
            'dj_id' => $availableDj->id, 
            'fecha_evento' => $date,
            'direccion_evento' => $request->direccion_evento,
            'telefono_cliente' => $request->telefono_cliente,
            'observaciones' => $request->observaciones,
            'estado_id' => $statusId
        ]);

        foreach ($plan->equipos as $equipo) {
             \App\Models\ReservaEquipo::create([
                 'reserva_id' => $reserva->id,
                 'equipo_id' => $equipo->id,
                 'cantidad' => $equipo->pivot->cantidad
             ]);
        }

        // --- 🤖 PRO AUTOMATIONS: INTELLIGENT FEEDBACK ---
        if ($isRushEvent) {
             \App\Services\AlertService::warning('Evento Relámpago Detectado', 'Tu reserva es en menos de 48h. Un coordinador te contactará de inmediato para logística urgente.');
        } elseif ($saturationWarning) {
             \App\Services\AlertService::info('Alta Demanda', 'Has asegurado uno de los últimos cupos para esta fecha. ¡Excelente elección!');
        } else {
             \App\Services\AlertService::success('Solicitud Enviada', 'Tu reserva está PENDIENTE. El administrador revisará tu evento.');
        }
        
        return redirect()->route('dashboard');
    }

    public function myEvents()
    {
        // For DJ
        $events = auth()->user()->events()->with(['user', 'plan', 'estado'])->latest()->get();
        return view('dj.events', compact('events'));
    }

    public function updateStatus(\Illuminate\Http\Request $request, \App\Models\Reserva $reserva)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados_reserva,id',
        ]);

        $newStatus = (int) $request->estado_id;

        // Strict Logic: Confirmation Checks
        if ($newStatus === 2) { // 2 = Confirmada
            $date = $reserva->fecha_evento;

            // 1. Check DJ availability for CONFIRMED events
            $conflictDj = \App\Models\Reserva::where('dj_id', $reserva->dj_id)
                ->where('fecha_evento', $date)
                ->where('estado_id', 2)
                ->where('id', '!=', $reserva->id)
                ->exists();

            if ($conflictDj) {
                \App\Services\AlertService::error('Conflicto DJ', 'El DJ asignado ya tiene una reserva confirmada para esta fecha.');
                return back();
            }

            // 2. Check Equipment stock for CONFIRMED events
            foreach ($reserva->plan->equipos as $equipo) {
                $required = $equipo->pivot->cantidad;
                
                $reserved = \App\Models\ReservaEquipo::whereHas('reserva', function($q) use ($date, $reserva) {
                    $q->where('fecha_evento', $date)
                      ->where('estado_id', 2)
                      ->where('id', '!=', $reserva->id);
                })->where('equipo_id', $equipo->id)->sum('cantidad');

                if (($equipo->cantidad_total - $reserved) < $required) {
                    \App\Services\AlertService::error('Stock Insuficiente', "No hay suficientes unidades de {$equipo->nombre} para esta fecha.");
                    return back();
                }
            }
        }

        $reserva->update([
            'estado_id' => $newStatus
        ]);

        if ($newStatus === 2) {
            \App\Services\AlertService::success('Reserva Confirmada', 'El evento ha sido aprobado y el equipo asignado.');
        } elseif ($newStatus === 3) {
            \App\Services\AlertService::warning('Reserva Rechazada', 'El evento ha sido cancelado y el horario liberado.');
        } else {
             \App\Services\AlertService::info('Estado Actualizado', 'El estado de la reserva ha cambiado.');
        }

        return back();
    }

    public function assignDj(\Illuminate\Http\Request $request, \App\Models\Reserva $reserva)
    {
        $request->validate([
            'dj_id' => 'required|exists:users,id',
        ]);

        $reserva->update([
            'dj_id' => $request->dj_id
        ]);

        \App\Services\AlertService::success('DJ Reasignado', 'El personal técnico ha sido actualizado correctamente.');
        return back();
    }

    /**
     * Marcar reserva como finalizada (solo admin, solo confirmadas).
     */
    public function finalize(\App\Models\Reserva $reserva)
    {
        // Solo se pueden finalizar reservas confirmadas
        if ($reserva->estado_id !== 2) {
            \App\Services\AlertService::error('Acción Inválida', 'Solo se pueden finalizar reservas que estén Confirmadas.');
             return back();
        }

        $reserva->update(['estado_id' => 4]); // 4 = Finalizada

        \App\Services\AlertService::success('Evento Finalizado', 'El servicio ha concluido exitosamente.');
        return back();
    }

    public function destroy(\App\Models\Reserva $reserva)
    {
        $reserva->delete();
        \App\Services\AlertService::warning('Reserva Eliminada', 'La reserva ha sido rechazada y eliminada del sistema.');
        return back();
    }
}
