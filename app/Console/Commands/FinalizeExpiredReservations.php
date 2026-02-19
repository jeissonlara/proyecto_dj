<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class FinalizeExpiredReservations extends Command
{
    protected $signature = 'reservas:finalize';
    protected $description = 'Finaliza automáticamente las reservas confirmadas cuyo evento ya pasó';

    public function handle(): int
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $currentTime = $now->toTimeString();

        // Case 1: Reservas with hora_fin set — finalize if fecha_evento + hora_fin < now
        $withHora = Reserva::where('estado_id', 2) // Confirmada
            ->whereNotNull('hora_fin')
            ->where(function ($q) use ($today, $currentTime) {
                $q->where('fecha_evento', '<', $today) // event date already past
                  ->orWhere(function ($q2) use ($today, $currentTime) {
                      $q2->where('fecha_evento', '=', $today)
                         ->where('hora_fin', '<=', $currentTime);
                  });
            })
            ->get();

        // Case 2: Reservas without hora_fin — finalize if fecha_evento < today
        $withoutHora = Reserva::where('estado_id', 2)
            ->whereNull('hora_fin')
            ->where('fecha_evento', '<', $today)
            ->get();

        $all = $withHora->merge($withoutHora);
        $count = $all->count();

        if ($count === 0) {
            $this->info('No hay reservas para finalizar.');
            return Command::SUCCESS;
        }

        foreach ($all as $reserva) {
            $reserva->update(['estado_id' => 4]); // 4 = Finalizada
            Log::info("Reserva #{$reserva->id} finalizada automáticamente (evento: {$reserva->fecha_evento})");
        }

        $this->info("✅ {$count} reserva(s) finalizada(s) correctamente.");
        Log::info("Scheduler: {$count} reserva(s) finalizada(s) automáticamente.");

        return Command::SUCCESS;
    }
}
