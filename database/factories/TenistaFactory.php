<?php

namespace Database\Factories;

use App\Models\Tenista;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TenistaFactory extends Factory
{
    protected $model = Tenista::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'nombre' => $this->faker->word(),
            'apellido' => $this->faker->word(),
            'ranking' => $this->faker->randomNumber(),
            'pais' => $this->faker->word(),
            'FechaNacimiento' => Carbon::now(),
            'edad' => $this->faker->randomNumber(),
            'Altura' => $this->faker->randomFloat(),
            'peso' => $this->faker->randomFloat(),
            'Mano' => $this->faker->word(),
            'reves' => $this->faker->word(),
            'entrenador' => $this->faker->word(),
            'totalDineroGanado' => $this->faker->word(),
            'numeroVictorias' => $this->faker->randomNumber(),
            'numeroDerrortas' => $this->faker->randomNumber(),
            'imagen' => $this->faker->word(),
            'puntos' => $this->faker->randomNumber(),
        ];
    }
}
