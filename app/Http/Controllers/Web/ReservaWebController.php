<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Reserva;


class ReservaWebController extends Controller
{
    public function crear()
    {
        $planes = Plan::all();
        return view('reservas.crear', compact('planes'));
    }

    public function index()
    {
        $reservas = Reserva::with(['user','plan', 'dj' ,'estado'])->get();
        return view('reservas.index', compact('reservas'));
    }

    public function cancelar($id)
    {
            $reserva = Reserva::findOrFail($id);
            $reserva->estado_id = 3; // 3 = cancelada (el verdadero)
            $reserva->save();

    return redirect()->route('reservas.index');
}

}
