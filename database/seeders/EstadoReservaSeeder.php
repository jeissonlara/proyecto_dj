<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados_reserva')->insertOrIgnore([
            ['id' => 1, 'nombre' => 'Pendiente'],
            ['id' => 2, 'nombre' => 'Confirmada'],
            ['id' => 3, 'nombre' => 'Cancelada'],
            ['id' => 4, 'nombre' => 'Finalizada'],
        ]);
    }
}