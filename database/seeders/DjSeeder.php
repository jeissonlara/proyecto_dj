<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    DB::table('djs')->insert([
        ['nombre' => 'DJ Carlos Medina'],
        ['nombre' => 'DJ David Miusic Producer'],
        ['nombre' => 'DJ FernandoMix'],
        ['nombre' => 'DJ Peña Colombia'],
        ['nombre' => 'Dj Camila Mix'],
    ]);
}
}
