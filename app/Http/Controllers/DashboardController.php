<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\EstadoReserva;
use App\Models\Reserva;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $reservasCount    = Reserva::count();
            $equiposCount     = Equipo::count();
            $finalizadasCount = Reserva::where('estado_id', EstadoReserva::FINALIZADA)->count();
            $finalizadasMes   = Reserva::where('estado_id', EstadoReserva::FINALIZADA)
                ->whereMonth('fecha_evento', now()->month)
                ->whereYear('fecha_evento', now()->year)
                ->count();

            return view('dashboard.admin', compact(
                'reservasCount',
                'equiposCount',
                'finalizadasCount',
                'finalizadasMes'
            ));
        }

        if ($user->isDj()) {
            $eventsCount = $user->events()->count();
            return view('dashboard.dj', compact('eventsCount'));
        }

        // Cliente
        $myReservations = $user->reservas()->with(['plan', 'estado'])->latest()->get();
        return view('dashboard.client', compact('myReservations'));
    }
}
