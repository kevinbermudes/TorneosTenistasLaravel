<?php

namespace Tests\Unit;

use App\Models\Tenista;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TenistaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        $response = $this->get(route('tenistas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tenista.index');
        $response->assertViewHasAll(['tenistas', 'topThreeTenistas', 'topTenTenistas']);
    }

    public function testShow()
    {
        $tenista = Tenista::factory()->create();

        $response = $this->get(route('tenistas.show', $tenista->id));

        $response->assertStatus(200);
        $response->assertViewIs('tenista.show');
        $response->assertViewHas('tenista', $tenista);
    }

    public function testCreate()
    {
        $response = $this->get(route('tenistas.create'));

        $response->assertStatus(200);
        $response->assertViewIs('tenista.create');
        $response->assertViewHasAll(['topThreeTenistas', 'topTenTenistas']);
    }

    public function testEdit()
    {
        $tenista = Tenista::factory()->create();

        $response = $this->get(route('tenistas.edit', $tenista->id));

        $response->assertStatus(200);
        $response->assertViewIs('tenista.edit');
        $response->assertViewHas('tenista', $tenista);
    }

    public function testStore()
    {
        $data = [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'pais' => $this->faker->country,
            'FechaNacimiento' => $this->faker->date(),
            'Altura' => $this->faker->numberBetween(150, 200),
            'peso' => $this->faker->numberBetween(50, 100),
            'Mano' => 'derecha',
            'reves' => 'dos manos',
            'entrenador' => $this->faker->name,
            'totalDineroGanado' => $this->faker->numberBetween(10000, 1000000),
            'numeroVictorias' => $this->faker->numberBetween(0, 100),
            'numeroDerrortas' => $this->faker->numberBetween(0, 100),
            'puntos' => $this->faker->numberBetween(0, 10000),
            'imagen' => 'default.jpg',
        ];

        $response = $this->post(route('tenistas.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('tenistas.index'));
        $response->assertSessionHas('success', 'Tenista creado con éxito.');

        $this->assertDatabaseHas('tenistas', $data);
    }

    public function testUpdate()
    {
        $tenista = Tenista::factory()->create();

        $data = [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'pais' => $this->faker->country,
            'FechaNacimiento' => $this->faker->date(),
            'Altura' => $this->faker->numberBetween(150, 200),
            'peso' => $this->faker->numberBetween(50, 100),
            'Mano' => 'izquierda',
            'reves' => 'una mano',
            'entrenador' => $this->faker->name,
            'totalDineroGanado' => $this->faker->numberBetween(10000, 1000000),
            'numeroVictorias' => $this->faker->numberBetween(0, 100),
            'numeroDerrortas' => $this->faker->numberBetween(0, 100),
            'puntos' => $this->faker->numberBetween(0, 10000),
            'imagen' => 'updated.jpg',
        ];

        $response = $this->put(route('tenistas.update', $tenista->id), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('tenistas.index'));
        $response->assertSessionHas('success', 'Tenista actualizado con éxito.');

        $this->assertDatabaseHas('tenistas', array_merge(['id' => $tenista->id], $data));
    }

    public function testDestroy()
    {
        $tenista = Tenista::factory()->create();

        $response = $this->delete(route('tenistas.destroy', $tenista->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('tenistas.index'));
        $response->assertSessionHas('success', 'Tenista eliminado con éxito.');

        $this->assertSoftDeleted('tenistas', ['id' => $tenista->id]);
    }

    public function testEditImage()
    {
        $tenista = Tenista::factory()->create();

        $response = $this->get(route('tenistas.editImage', $tenista->id));

        $response->assertStatus(200);
        $response->assertViewIs('tenista.image');
        $response->assertViewHas('tenista', $tenista);
    }

    public function testUpdateImage()
    {
        Storage::fake('public');

        $tenista = Tenista::factory()->create();

        $file = UploadedFile::fake()->image('tenista.jpg');

        $response = $this->patch(route('tenistas.updateImage', $tenista->id), [
            'imagen' => $file,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('tenistas.index'));
        $response->assertSessionHas('success', 'Imagen del tenista actualizada con éxito.');

        Storage::disk('public')->assertExists('tenistas/' . $file->hashName());
    }

    public function testDeleted()
    {
        $response = $this->get(route('tenistas.deleted'));

        $response->assertStatus(200);
        $response->assertViewIs('tenista.deleted');
        $response->assertViewHas('tenistas');
    }

    public function testRestore()
    {
        $tenista = Tenista::factory()->create([
            'deleted_at' => now(),
        ]);

        $response = $this->put(route('tenistas.restore', $tenista->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('tenistas.deleted'));
        $response->assertSessionHas('success', 'Tenista recuperado con éxito.');

        $this->assertDatabaseHas('tenistas', ['id' => $tenista->id, 'deleted_at' => null]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }


    protected function getTenista($id)
    {
        $tenista = Cache::get('tenista' . $id);

        if (!$tenista) {
            $tenista = Tenista::findOrFail($id);
            Cache::put('tenista' . $id, $tenista, 300);
        }

        return $tenista;
    }


}
