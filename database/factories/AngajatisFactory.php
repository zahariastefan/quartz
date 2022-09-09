<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Angajatis>
 */
class AngajatisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_departament' => '',
            'nume' => $this->faker->firstName,
            'prenume' => $this->faker->lastName,
            'cnp' => $this->faker->numberBetween(1900000000000, 5900000000000),
            'salariu' => $this->faker->numberBetween(2500,7500),
            'zile_concediu' => $this->faker->numberBetween(10,55),
        ];
    }
}
