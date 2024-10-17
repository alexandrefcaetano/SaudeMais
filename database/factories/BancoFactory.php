<?php

namespace Database\Factories;

use App\Models\Banco;
use Illuminate\Database\Eloquent\Factories\Factory;

class BancoFactory extends Factory
{
    protected $model = Banco::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'banco'        => $this->faker->company,
            'ativo'        => $this->faker->randomElement(['S', 'N']),
            'provincia_id' => $this->faker->numberBetween(1, 100),
            'municipio_id' => $this->faker->numberBetween(1, 100),
            'pais_id'      => $this->faker->numberBetween(1, 200),
            'codigoswift'  => $this->faker->swiftBicNumber,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
