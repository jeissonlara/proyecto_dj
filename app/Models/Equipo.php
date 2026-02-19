<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'nombre',
        'tipo', // cabina, consola, luces, ...
        'cantidad_total',
        'cantidad_disponible',
        'estado', // disponible, mantenimineto
        'descripcion'
    ];

    // Scopes
    public function scopeDisponible($query)
    {
        return $query->where('estado', 'disponible')->where('cantidad_disponible', '>', 0);
    }

    public function scopeTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function planes()
    {
        return $this->belongsToMany(Plan::class, 'plan_equipos')
                    ->withPivot('cantidad');
    }

    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'reserva_equipos')
                    ->withPivot('cantidad');
    }
}

