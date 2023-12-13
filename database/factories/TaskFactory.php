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
            'user_id' => $this->faker->randomDigit(),
            'board_id' => $this->faker->randomDigit(),
            'board_list_id' => $this->faker->randomDigit(),
            'task_slug' => $this->faker->slug(mt_rand(1, 4)),
            'task_title' => $this->faker->sentence(mt_rand(1, 4)),
            'task_desc' => $this->faker->sentence(5),
            'due_date' => $this->faker->dateTime(),
        ];
    }
}
