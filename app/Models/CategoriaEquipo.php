<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaEquipo extends Model
{
    protected $table = 'categorias_equipos';

    protected $fillable = ['nombre'];

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'categoria_id');
    }
}

