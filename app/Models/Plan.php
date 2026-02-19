<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Plan extends Model 
{

protected $table = 'planes';

protected $fillable = ['nombre', 'precio', 'descripcion', 'imagen'];

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'plan_equipos')
                    ->withPivot('cantidad');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}

