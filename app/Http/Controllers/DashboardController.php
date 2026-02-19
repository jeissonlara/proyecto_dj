<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $reservasCount = \App\Models\Reserva::count();
            $equiposCount = \App\Models\Equipo::count();
            $finalizadasCount = \App\Models\Reserva::where('estado_id', 4)->count();
            $finalizadasMes = \App\Models\Reserva::where('estado_id', 4)
                ->whereMonth('fecha_evento', now()->month)
                ->whereYear('fecha_evento', now()->year)
                ->count();
            return view('dashboard.admin', compact('reservasCount', 'equiposCount', 'finalizadasCount', 'finalizadasMes'));
        }

        if ($user->isDj()) {
            $eventsCount = $user->events()->count(); // assuming helper 'events' or direct relation
            return view('dashboard.dj', compact('eventsCount'));
        }

        // Client
        $myReservations = $user->reservas()->latest()->get();
        return view('dashboard.client', compact('myReservations'));
    }
}
