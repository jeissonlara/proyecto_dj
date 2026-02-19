<?php

namespace App\Services;

use App\Models\EstadoReserva;
use App\Models\Plan;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\User;
use Carbon\Carbon;

class ReservacionService
{
    /**
     * Selecciona el DJ óptimo para una fecha usando la rotación inteligente:
     * 1. Menos reservas activas (excluye rechazadas)
     * 2. Desempate: evento más antiguo
     *
     * @param  string $fecha  Fecha del evento (Y-m-d)
     * @return User|null
     */
    public function asignarDjOptimo(string $fecha): ?User
    {
        return User::where('role', User::ROLE_DJ)
            ->leftJoin('reservas', function ($join) {
                $join->on('users.id', '=', 'reservas.dj_id')
                     ->where('reservas.estado_id', '!=', EstadoReserva::RECHAZADA);
            })
            ->select('users.*')
            ->selectRaw('COUNT(reservas.id) as events_count')
            ->selectRaw('MAX(reservas.fecha_evento) as last_event_date')
            ->groupBy('users.id')
            ->orderBy('events_count', 'asc')
            ->orderBy('last_event_date', 'asc')
            ->first();
    }

    /**
     * Verifica si un DJ ya tiene un evento (no rechazado) para esa fecha.
     *
     * @param  int    $djId
     * @param  string $fecha
     * @param  int|null $excludeReservaId  Excluir la reserva actual al re-verificar
     * @return bool   true si hay conflicto
     */
    public function hayConflictoDj(int $djId, string $fecha, ?int $excludeReservaId = null): bool
    {
        $query = Reserva::where('dj_id', $djId)
            ->where('fecha_evento', $fecha)
            ->where('estado_id', '!=', EstadoReserva::RECHAZADA);

        if ($excludeReservaId) {
            $query->where('id', '!=', $excludeReservaId);
        }

        return $query->exists();
    }

    /**
     * Verifica si un DJ ya tiene una reserva CONFIRMADA para esa fecha.
     * Usado en la confirmación por parte del admin.
     *
     * @param  int    $djId
     * @param  string $fecha
     * @param  int    $excludeReservaId
     * @return bool
     */
    public function hayConflictoConfirmado(int $djId, string $fecha, int $excludeReservaId): bool
    {
        return Reserva::where('dj_id', $djId)
            ->where('fecha_evento', $fecha)
            ->where('estado_id', EstadoReserva::CONFIRMADA)
            ->where('id', '!=', $excludeReservaId)
            ->exists();
    }

    /**
     * Verifica si hay stock suficiente de todos los equipos del plan para una fecha.
     * Retorna el nombre del equipo con stock insuficiente o null si todo está bien.
     *
     * @param  Reserva $reserva
     * @return string|null  Nombre del equipo con stock insuficiente, o null si OK.
     */
    public function verificarStockParaConfirmacion(Reserva $reserva): ?string
    {
        $fecha = $reserva->fecha_evento;

        // Cargar relaciones si no están cargadas
        $reserva->loadMissing(['plan.equipos']);

        foreach ($reserva->plan->equipos as $equipo) {
            $required = $equipo->pivot->cantidad;

            $reserved = ReservaEquipo::whereHas('reserva', function ($q) use ($fecha, $reserva) {
                $q->where('fecha_evento', $fecha)
                  ->where('estado_id', EstadoReserva::CONFIRMADA)
                  ->where('id', '!=', $reserva->id);
            })
            ->where('equipo_id', $equipo->id)
            ->sum('cantidad');

            if (($equipo->cantidad_total - $reserved) < $required) {
                return $equipo->nombre;
            }
        }

        return null;
    }

    /**
     * Crea una reserva completa:
     * - Asigna DJ óptimo
     * - Copia equipos del plan a reserva_equipos
     * - Retorna la reserva creada
     *
     * Lanza una excepción descubierta si no hay DJ disponible o hay conflicto.
     *
     * @param  array $data  Datos validados (plan_id, fecha_evento, direccion_evento, etc.)
     * @param  int   $userId
     * @return array ['reserva' => Reserva, 'dj' => User, 'isRush' => bool, 'isSaturated' => bool]
     * @throws \RuntimeException
     */
    public function crearReserva(array $data, int $userId): array
    {
        $plan  = Plan::with('equipos')->findOrFail($data['plan_id']);
        $fecha = $data['fecha_evento'];

        // Seleccionar DJ óptimo
        $dj = $this->asignarDjOptimo($fecha);
        if (!$dj) {
            throw new \RuntimeException('No hay personal de DJ disponible en el sistema. Contacte a soporte.');
        }

        // Verificar conflicto de doble booking
        if ($this->hayConflictoDj($dj->id, $fecha)) {
            throw new \RuntimeException('El DJ asignado automáticamente tiene un conflicto. Intente otra fecha.');
        }

        // Calcular flags de automatización
        $isRush      = Carbon::parse($fecha)->diffInHours(now()) < 48;
        $isSaturated = Reserva::where('fecha_evento', $fecha)
            ->where('estado_id', '!=', EstadoReserva::RECHAZADA)
            ->count() >= 2;

        // Obtener ID de estado Pendiente dinámicamente
        $estadoPendiente = EstadoReserva::where('nombre', 'Pendiente')->first();
        $estadoId        = $estadoPendiente ? $estadoPendiente->id : EstadoReserva::PENDIENTE;

        // Crear la reserva
        $reserva = Reserva::create([
            'user_id'          => $userId,
            'plan_id'          => $plan->id,
            'dj_id'            => $dj->id,
            'fecha_evento'     => $fecha,
            'direccion_evento' => $data['direccion_evento'],
            'telefono_cliente' => $data['telefono_cliente'],
            'observaciones'    => $data['observaciones'] ?? null,
            'estado_id'        => $estadoId,
        ]);

        // Copiar equipos del plan a la reserva
        foreach ($plan->equipos as $equipo) {
            ReservaEquipo::create([
                'reserva_id' => $reserva->id,
                'equipo_id'  => $equipo->id,
                'cantidad'   => $equipo->pivot->cantidad,
            ]);
        }

        return [
            'reserva'     => $reserva,
            'dj'          => $dj,
            'isRush'      => $isRush,
            'isSaturated' => $isSaturated,
        ];
    }

    /**
     * Verifica si la fecha tiene disponibilidad de DJs.
     * Un DJ se considera ocupado si tiene una reserva NO rechazada en esa fecha.
     *
     * @param  string $fecha
     * @return bool
     */
    public function hayDisponibilidad(string $fecha): bool
    {
        $totalDjs = User::where('role', User::ROLE_DJ)->count();

        $djsOcupados = Reserva::where('fecha_evento', $fecha)
            ->where('estado_id', '!=', EstadoReserva::RECHAZADA)
            ->distinct('dj_id')
            ->count('dj_id');

        return $djsOcupados < $totalDjs;
    }
}
