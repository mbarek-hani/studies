<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(3),
            "auteur" => fake()->name(),
            "annee" => fake()->year(),
            "isbn" => fake()->unique()->isbn13(),
            "editeur" => fake()->name(),
        ];
    }
}
