<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PlanEquipoSeeder extends Seeder
{
    public function run(): void
{
    DB::table('plan_equipos')->insert([
        // Plan Básico
        [
            'plan_id' => 1,
            'equipo_id' => 1,
            'cantidad' => 2
        ],
        [
            'plan_id' => 1,
            'equipo_id' => 2,
            'cantidad' => 4
        ],

        // Plan Premium
        [
            'plan_id' => 2,
            'equipo_id' => 1,
            'cantidad' => 3
        ],
        [
            'plan_id' => 2,
            'equipo_id' => 2,
            'cantidad' => 6
        ],
        [
            'plan_id' => 2,
            'equipo_id' => 3,
            'cantidad' => 1
        ],
    ]);
}
}