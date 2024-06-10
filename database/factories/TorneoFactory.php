<?php

namespace Database\Factories;

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TorneoFactory extends Factory
{
    protected $model = Torneo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'modalidad' => $this->faker->randomElement(['individual', 'dobles', 'mixto']),
            'superficie' => $this->faker->randomElement(['dura', 'arcilla', 'hierba']),
            'vacantes' => $this->faker->numberBetween(8, 64),
            'categoria' => $this->faker->randomElement(['atp 250', 'atp 500', 'atp 1000']),
            'premios' => $this->faker->numberBetween(1000, 50000),
            'fechaInicio' => $this->faker->date(),
            'fechaFin' => $this->faker->date(),
            'isDelete' => false,
            'imagen' => 'default.jpg',
        ];
    }
}
