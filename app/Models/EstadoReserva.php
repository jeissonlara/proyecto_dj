<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoReserva extends Model
{
    protected $table = 'estados_reserva';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    // ── Estado Constants (eliminan magic numbers en todo el proyecto) ──
    const PENDIENTE  = 1;
    const CONFIRMADA = 2;
    const RECHAZADA  = 3;
    const FINALIZADA = 4;

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'estado_id');
    }
}
