<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Plan;
use App\Models\Equipo;
use App\Models\Reserva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed statuses
        \App\Models\EstadoReserva::unguard();
        \App\Models\EstadoReserva::create(['id' => 1, 'nombre' => 'Pendiente']);
        \App\Models\EstadoReserva::create(['id' => 2, 'nombre' => 'Confirmada']);
        \App\Models\EstadoReserva::create(['id' => 3, 'nombre' => 'Cancelada']);
        \App\Models\EstadoReserva::create(['id' => 4, 'nombre' => 'Completada']);
        \App\Models\EstadoReserva::reguard();
    }

    public function test_client_can_book_if_inventory_available()
    {
        // 1. Setup Data
        $client = User::factory()->create(['role' => 'client']);
        $admin = User::factory()->create(['role' => 'admin']); // For DJ assignment logic if needed
        $dj = User::factory()->create(['role' => 'dj']);

        // Equipment: Speaker (Total 5)
        $speaker = Equipo::create([
            'nombre' => 'Speaker Pro',
            'tipo' => 'sonido',
            'cantidad_total' => 5,
            'cantidad_disponible' => 5, // Not strictly used for date logic but good to have
            'estado' => 'disponible',
            'descripcion' => 'Loud speaker'
        ]);

        // Plan: Basic (Uses 2 Speakers)
        $plan = Plan::create([
            'nombre' => 'Basic Party',
            'precio' => 100,
            'descripcion' => 'Simple setup'
        ]);
        $plan->equipos()->attach($speaker->id, ['cantidad' => 2]);

        // 2. Client logs in
        $this->actingAs($client);

        // 3. Attempt Booking for Date A (Succesful)
        $date = '2026-12-31';
        $response = $this->post(route('client.reservations.store'), [
            'plan_id' => $plan->id,
            'fecha_evento' => $date,
            'direccion_evento' => '123 Main St'
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('reservas', [
            'user_id' => $client->id,
            'fecha_evento' => $date
        ]);
        // Traceability check
        $this->assertDatabaseHas('reserva_equipos', [
            'equipo_id' => $speaker->id,
            'cantidad' => 2
        ]);
    }

    public function test_client_cannot_book_if_inventory_full_for_date()
    {
        // 1. Setup Data
        $client = User::factory()->create(['role' => 'client']);
        $dj = User::factory()->create(['role' => 'dj']);

        // Equipment: Speaker (Total 3) - Only enough for 1 booking of Basic Plan (needs 2)
        $speaker = Equipo::create([
            'nombre' => 'Speaker Pro',
            'tipo' => 'sonido',
            'cantidad_total' => 3, 
            'cantidad_disponible' => 3,
            'estado' => 'disponible',
            'descripcion' => 'Loud speaker'
        ]);

        $plan = Plan::create([
            'nombre' => 'Basic Party',
            'precio' => 100,
            'descripcion' => 'Simple setup'
        ]);
        $plan->equipos()->attach($speaker->id, ['cantidad' => 2]);

        $this->actingAs($client);
        $date = '2026-12-31';

        // 2. First Booking (Uses 2/3) -> OK
        $this->post(route('client.reservations.store'), [
            'plan_id' => $plan->id,
            'fecha_evento' => $date,
            'direccion_evento' => 'Party 1'
        ])->assertRedirect(route('dashboard'));

        // 3. Second Booking (Needs 2 more, total 4 > 3) -> FAIL
        $response = $this->post(route('client.reservations.store'), [
            'plan_id' => $plan->id,
            'fecha_evento' => $date,
            'direccion_evento' => 'Party 2'
        ]);

        $response->assertSessionHasErrors(); // Should fail validation/logic
    }

    public function test_booking_on_different_dates_is_independent()
    {
        // 1. Setup Data
        $client = User::factory()->create(['role' => 'client']);
        $dj = User::factory()->create(['role' => 'dj']);

        // Equipment: Speaker (Total 2) - Enough for exactly 1 booking
        $speaker = Equipo::create([
            'nombre' => 'Speaker Pro',
            'tipo' => 'sonido',
            'cantidad_total' => 2,
            'cantidad_disponible' => 2,
            'estado' => 'disponible',
            'descripcion' => 'Loud speaker'
        ]);

        $plan = Plan::create([
            'nombre' => 'Basic Party',
            'precio' => 100,
            'descripcion' => 'Simple setup'
        ]);
        $plan->equipos()->attach($speaker->id, ['cantidad' => 2]);

        $this->actingAs($client);

        // 2. Booking Date A (Uses 2/2) -> OK
        $this->post(route('client.reservations.store'), [
            'plan_id' => $plan->id,
            'fecha_evento' => '2026-12-31',
            'direccion_evento' => 'Party 1'
        ])->assertRedirect(route('dashboard'));

        // 3. Booking Date B (Uses 2/2) -> OK (Equipment should be available for different date)
        $this->post(route('client.reservations.store'), [
            'plan_id' => $plan->id,
            'fecha_evento' => '2027-01-01',
            'direccion_evento' => 'Party 2'
        ])->assertRedirect(route('dashboard'));
    }
}
