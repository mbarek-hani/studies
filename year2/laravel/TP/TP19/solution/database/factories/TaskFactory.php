<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3, false),
            'description' => $this->faker->paragraph(2, false),
            'status' => $this->faker->randomElement(['completed', 'in_progress', 'pending']),
            'priority' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'user_id' => 1
        ];
    }
}
