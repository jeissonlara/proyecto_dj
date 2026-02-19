<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaEquipoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias_equipos')->insert([
            ['nombre' => 'Sonido'],
            ['nombre' => 'Iluminación'],
            ['nombre' => 'Humo'],
        ]);
    }
}
