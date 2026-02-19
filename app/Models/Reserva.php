<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'dj_id',
        'fecha_evento',
        'hora_inicio',
        'hora_fin',
        'direccion_evento',
        'telefono_cliente',
        'observaciones',
        'estado_id'
    ];

    protected $casts = [
        'fecha_evento' => 'date',
    ];

    // ── Relationships ──

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function dj()
    {
        return $this->belongsTo(User::class, 'dj_id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoReserva::class, 'estado_id');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'reserva_equipos')
                    ->withPivot('cantidad');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    // ── Helpers ──

    public function isFinalized(): bool
    {
        return $this->estado_id === EstadoReserva::FINALIZADA;
    }

    public function isConfirmed(): bool
    {
        return $this->estado_id === EstadoReserva::CONFIRMADA;
    }

    /**
     * Scope: reservas confirmadas cuyo evento ya pasó.
     */
    public function scopeExpired($query)
    {
        $now = Carbon::now();
        return $query->where('estado_id', 2)
            ->where(function ($q) use ($now) {
                $q->where('fecha_evento', '<', $now->toDateString())
                  ->orWhere(function ($q2) use ($now) {
                      $q2->where('fecha_evento', '=', $now->toDateString())
                         ->whereNotNull('hora_fin')
                         ->where('hora_fin', '<=', $now->toTimeString());
                  });
            });
    }
}
