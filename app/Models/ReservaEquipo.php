<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ReservaEquipo extends Pivot
{
    protected $table = 'reserva_equipos';

    protected $fillable = [
        'reserva_id',
        'equipo_id',
        'cantidad'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
