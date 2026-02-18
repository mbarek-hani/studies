<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(8),
            "start_date" => fake()->dateTimeBetween("now", "+3 days"),
            "end_date" => fake()->dateTimeBetween("+4 days", "+1 month"),
            "category" => fake()->word(),
            "participants_count" => fake()->numberBetween(100, 6000),
        ];
    }
}
