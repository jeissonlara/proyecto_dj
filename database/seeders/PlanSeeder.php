<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Equipo;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Plan Básico
        $basic = Plan::firstOrCreate(
            ['nombre' => 'Plan Básico'],
            ['precio' => 150.00, 'descripcion' => 'Ideal para fiestas pequeñas']
        );
        $this->attachEquipo($basic, 'Cabina LED 3D', 1);
        $this->attachEquipo($basic, 'Consola Pioneer XDJ', 1);
        $this->attachEquipo($basic, 'Luces Par LED', 2);

        // 2. Plan Intermedio
        $inter = Plan::firstOrCreate(
            ['nombre' => 'Plan Intermedio'],
            ['precio' => 300.00, 'descripcion' => 'Para eventos medianos']
        );
        $this->attachEquipo($inter, 'Cabina LED 3D', 3);
        $this->attachEquipo($inter, 'Consola Pioneer XDJ', 1);
        $this->attachEquipo($inter, 'Luces Par LED', 4);
        $this->attachEquipo($inter, 'Cabezas Moviles Beam',1);
        $this->attachEquipo($inter, 'Máquina de Humo 1000W', 1);

        // 3. Plan Avanzado
        $adv = Plan::firstOrCreate(
            ['nombre' => 'Plan Avanzado'],
            ['precio' => 600.00, 'descripcion' => 'Calidad profesional']
        );
        $this->attachEquipo($adv, 'Cabina LED 3D', 4);
        $this->attachEquipo($adv, 'Consola Pioneer Nexus', 1);
        $this->attachEquipo($adv, 'Cabezas Móviles Beam', 4);
        $this->attachEquipo($adv, 'Máquina de Humo 1000W', 2);
        $this->attachEquipo($adv, 'show hora loca led personalizado',1);

        // 4. Plan Premium
        $prem = Plan::firstOrCreate(
            ['nombre' => 'Plan Premium'],
            ['precio' => 1000.00, 'descripcion' => 'Todo incluido, máxima potencia']
        );
        $this->attachEquipo($prem, 'Cabina LED 3D', 6);
        $this->attachEquipo($prem, 'Consola Pioneer Nexus', 1);
        $this->attachEquipo($prem, 'Cabezas Móviles Beam', 8);
        $this->attachEquipo($prem, 'Luces Par LED', 8);
        $this->attachEquipo($prem, 'Máquina de Humo 1000W', 3);
        $this->attachEquipo($prem, 'Micrófono Shure SM58', 4);
        $this->attachEquipo($prem, 'show sorpresa mas regalos',10);
    }

    private function attachEquipo($plan, $nombreEquipo, $cantidad)
    {
        $equipo = Equipo::where('nombre', $nombreEquipo)->first();
        if ($equipo) {
            // Check if already attached to avoid duplicates if re-running
            if (!$plan->equipos()->where('equipo_id', $equipo->id)->exists()) {
                $plan->equipos()->attach($equipo->id, ['cantidad' => $cantidad]);
            }
        }
    }
}