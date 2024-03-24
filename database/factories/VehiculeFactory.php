<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicule>
 */
class VehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'matricule' => fake()->regexify("[A-Z]{3}-[0-9]{3}-[A-Z]{3}"),
            'image' => "defaut-car.png",
            'km_defaut' => fake()->randomFloat(3, 0, 500),
            'km_actuel' => fake()->randomFloat(3, 500, 10000),
            'status' => "DISPONIBLE",
            'category_id' => random_int(1, 7),
            'date_achat' => fake()->date(),
        ];
    }
}
