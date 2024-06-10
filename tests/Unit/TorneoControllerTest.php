<?php

namespace Tests\Unit;

use App\Models\Torneo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TorneoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testShowValidId()
    {
        $torneo = Torneo::factory()->create();

        $response = $this->get(route('torneos.show', $torneo->id));

        $response->assertStatus(200);
        $response->assertViewIs('torneo.show');
        $response->assertViewHas('torneo', $torneo);
    }

    public function testShowInvalidId()
    {
        $invalidId = Str::uuid();

        $response = $this->get(route('torneos.show', $invalidId));

        $response->assertStatus(302);
        $response->assertRedirect(route('torneos.index'));
        $response->assertSessionHas('error', 'Torneo no encontrado.');
    }

    public function testShowInvalidUuid()
    {
        $invalidUuid = 'invalid-uuid';

        $response = $this->get(route('torneos.show', $invalidUuid));

        $response->assertStatus(302);
        $response->assertRedirect(route('torneos.index'));
        $response->assertSessionHas('error', 'ID de torneo no válido.');
    }

    public function testIndex()
    {
        $response = $this->get(route('torneos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('torneo.index');
        $response->assertViewHasAll(['torneos', 'topThreeTorneos', 'topTenTorneos']);
    }

    public function testCreate()
    {
        $response = $this->get(route('torneos.create'));

        $response->assertStatus(200);
        $response->assertViewIs('torneo.create');
    }

    public function testStore()
    {
        $data = [
            'nombre' => $this->faker->name,
            'modalidad' => 'individual',
            'superficie' => 'dura',
            'vacantes' => 16,
            'categoria' => 'atp 250',
            'premios' => 10000,
            'fechaInicio' => now()->format('Y-m-d'),
            'fechaFin' => now()->addWeek()->format('Y-m-d'),
            'imagen' => 'default.jpg',
        ];

        $response = $this->post(route('torneos.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('torneos.index'));
        $response->assertSessionHas('success', 'Torneo creado con éxito.');

        $this->assertDatabaseHas('torneos', $data);
    }

    public function testUpdate()
    {
        $torneo = Torneo::factory()->create();

        $data = [
            'nombre' => $this->faker->name,
            'modalidad' => 'dobles',
            'superficie' => 'arcilla',
            'vacantes' => 32,
            'categoria' => 'atp 500',
            'premios' => 20000,
            'fechaInicio' => now()->format('Y-m-d'),
            'fechaFin' => now()->addWeek()->format('Y-m-d'),
            'imagen' => 'updated.jpg',
        ];

        $response = $this->put(route('torneos.update', $torneo->id), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('torneos.index'));
        $response->assertSessionHas('success', 'Torneo actualizado con éxito.');

        $this->assertDatabaseHas('torneos', array_merge(['id' => $torneo->id], $data));
    }

    public function testDestroy()
    {
        $torneo = Torneo::factory()->create();

        $response = $this->delete(route('torneos.destroy', $torneo->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('torneos.index'));
        $response->assertSessionHas('success', 'Torneo eliminado con éxito.');

        $this->assertSoftDeleted('torneos', ['id' => $torneo->id]);
    }

    public function testEdit()
    {
        $torneo = Torneo::factory()->create();

        $response = $this->get(route('torneos.edit', $torneo->id));

        $response->assertStatus(200);
        $response->assertViewIs('torneo.edit');
        $response->assertViewHas('torneo', $torneo);
    }

    public function testEditImage()
    {
        $torneo = Torneo::factory()->create();
    }

    public function testUpdateImage()
    {
        $torneo = Torneo::factory()->create();
    }

    public function testDeleted()
    {
        $torneos = Torneo::where('isDelete', true)->get();
        return view('torneo.deleted', compact('torneos'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }


}
