<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Plan;
use App\Models\Reserva;
use App\Models\Equipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ApiFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed necessary data
        \App\Models\EstadoReserva::unguard();
        \App\Models\EstadoReserva::create(['id' => 1, 'nombre' => 'Pendiente']);
        \App\Models\EstadoReserva::create(['id' => 2, 'nombre' => 'Confirmada']);
        \App\Models\EstadoReserva::create(['id' => 3, 'nombre' => 'Cancelada']);
        \App\Models\EstadoReserva::create(['id' => 4, 'nombre' => 'Completada']);
        \App\Models\EstadoReserva::reguard();
    }

    public function test_api_login_returns_standard_json()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'token',
                    'user'
                ]
            ]);
    }

    public function test_api_get_planes_returns_standard_json()
    {
        Plan::create([
            'nombre' => 'Plan Test',
            'precio' => 100,
            'descripcion' => 'Desc'
        ]);

        $response = $this->getJson('/api/planes');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Planes obtenidos correctamente'
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'nombre', 'precio']
                ]
            ]);
    }

    public function test_api_create_reservation_flow()
    {
        // Setup DJ and Inventory
        $dj = User::factory()->create(['role' => 'dj']);
        $user = User::factory()->create(['role' => 'client']);
        
        $plan = Plan::create(['nombre' => 'Plan A', 'precio' => 100, 'descripcion' => 'A']);
        
        // Authenticate as user
        Sanctum::actingAs($user);

        // 1. Check availability
        $date = now()->addDays(5)->format('Y-m-d');
        $this->getJson("/api/disponibilidad/{$date}")
            ->assertStatus(200)
            ->assertJsonPath('data.disponible', true);

        // 2. Create Reservation
        $response = $this->postJson('/api/reservas', [
            'plan_id' => $plan->id,
            'fecha_evento' => $date,
            'direccion_evento' => 'Calle Falsa 123'
        ]);

        $response->assertStatus(201)
            ->assertJson(['success' => true]);
            
        $reservaId = $response->json('data.id');

        // 3. List Reservations
        $this->getJson('/api/reservas')
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $reservaId]);

        // 4. Cancel Reservation
        $this->putJson("/api/reservas/{$reservaId}/cancelar")
            ->assertStatus(200)
            ->assertJson(['success' => true]);
            
        $this->assertDatabaseHas('reservas', [
            'id' => $reservaId,
            'estado_id' => 3 // Cancelada
        ]);
    }
}
