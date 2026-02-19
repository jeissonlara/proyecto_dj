<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));

        // 1. Reservas por mes for the selected year
        $reservasPerMonth = \App\Models\Reserva::selectRaw('MONTH(fecha_evento) as month, count(*) as total')
            ->whereYear('fecha_evento', $year)
            ->groupBy('month')
            ->get();

        // 2. Plan más vendido
        $topPlanRecord = \App\Models\Reserva::selectRaw('plan_id, count(*) as total')
            ->whereYear('fecha_evento', $year)
            ->groupBy('plan_id')
            ->orderBy('total', 'desc')
            ->with('plan')
            ->first();

        // 3. DJ con más eventos
        $topDjRecord = \App\Models\Reserva::selectRaw('dj_id, count(*) as total')
            ->whereYear('fecha_evento', $year)
            ->where('estado_id', '!=', 3) // Exclude cancelled
            ->groupBy('dj_id')
            ->orderBy('total', 'desc')
            ->with('dj')
            ->first();

        // 4. Equipo más usado (by total quantity in reservations)
        $mostUsedEquipo = \App\Models\ReservaEquipo::whereHas('reserva', function($q) use ($year) {
                $q->whereYear('fecha_evento', $year);
            })
            ->selectRaw('equipo_id, sum(cantidad) as total_usage')
            ->groupBy('equipo_id')
            ->orderBy('total_usage', 'desc')
            ->with('equipo')
            ->first();

        // 5. Equipos ocupados actualmente (today)
        $today = date('Y-m-d');
        $occupiedEquipos = \App\Models\ReservaEquipo::whereHas('reserva', function($q) use ($today) {
            $q->where('fecha_evento', $today)->where('estado_id', '!=', 3);
        })->selectRaw('equipo_id, sum(cantidad) as total_cantidad')
          ->groupBy('equipo_id')
          ->with('equipo')
          ->get();

        // Available years for the filter
        $availableYears = \App\Models\Reserva::selectRaw('YEAR(fecha_evento) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($availableYears->isEmpty()) {
            $availableYears = collect([date('Y')]);
        }

        // 6. Total finalizadas for the year
        $totalFinalizadas = \App\Models\Reserva::where('estado_id', 4)
            ->whereYear('fecha_evento', $year)
            ->count();

        // 7. Porcentaje de eventos completados
        $totalReservasYear = \App\Models\Reserva::whereYear('fecha_evento', $year)->count();
        $porcentajeCompletados = $totalReservasYear > 0
            ? round(($totalFinalizadas / $totalReservasYear) * 100, 1)
            : 0;

        return view('admin.stats.index', [
            'reservasPerMonth' => $reservasPerMonth,
            'topPlan' => $topPlanRecord,
            'topDj' => $topDjRecord,
            'mostUsedEquipo' => $mostUsedEquipo,
            'occupiedEquipos' => $occupiedEquipos,
            'selectedYear' => $year,
            'availableYears' => $availableYears,
            'totalFinalizadas' => $totalFinalizadas,
            'porcentajeCompletados' => $porcentajeCompletados,
        ]);
    }
}
