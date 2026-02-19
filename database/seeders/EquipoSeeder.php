<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        $equipos = [
            ['nombre' => 'Cabina LED 3D', 'tipo' => 'cabina', 'cantidad_total' => 10, 'cantidad_disponible' => 10, 'descripcion' => 'Cabina iluminada'],
            ['nombre' => 'Consola Pioneer XDJ', 'tipo' => 'consola', 'cantidad_total' => 5, 'cantidad_disponible' => 5, 'descripcion' => 'Consola profesional'],
            ['nombre' => 'Consola Pioneer Nexus', 'tipo' => 'consola', 'cantidad_total' => 2, 'cantidad_disponible' => 2, 'descripcion' => 'Consola gama alta'],
            ['nombre' => 'Luces Par LED', 'tipo' => 'luces', 'cantidad_total' => 20, 'cantidad_disponible' => 20, 'descripcion' => 'Luces básicas'],
            ['nombre' => 'Cabezas Móviles Beam', 'tipo' => 'luces', 'cantidad_total' => 8, 'cantidad_disponible' => 8, 'descripcion' => 'Luces avanzadas'],
            ['nombre' => 'Cabezas Moviles Beam', 'tipo' => 'luces', 'cantidad_total' => 8, 'cantidad_disponible' => 8, 'descripcion' => 'Luces avanzadas typo'],
            ['nombre' => 'Máquina de Humo 1000W', 'tipo' => 'humo', 'cantidad_total' => 5, 'cantidad_disponible' => 5, 'descripcion' => 'Efecto humo'],
            ['nombre' => 'Micrófono Shure SM58', 'tipo' => 'microfono', 'cantidad_total' => 10, 'cantidad_disponible' => 10, 'descripcion' => 'Micrófono vocal'],
            ['nombre' => 'Cableado XLR', 'tipo' => 'accesorios', 'cantidad_total' => 50, 'cantidad_disponible' => 50, 'descripcion' => 'Cables necesarios'],
            ['nombre' => 'show hora loca led personalizado', 'tipo' => 'show', 'cantidad_total' => 10, 'cantidad_disponible' => 10, 'descripcion' => 'Show especial'],
            ['nombre' => 'show sorpresa mas regalos', 'tipo' => 'show', 'cantidad_total' => 10, 'cantidad_disponible' => 10, 'descripcion' => 'Show sorpresa'],
        ];

        foreach ($equipos as $e) {
            Equipo::firstOrCreate(
                ['nombre' => $e['nombre']],
                $e
            );
        }
    }
}