<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Dj extends Model
{
    protected $table = 'djs';

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'dj_id', 'id');
    }
}
