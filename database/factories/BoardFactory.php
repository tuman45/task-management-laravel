<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
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
            'board_name' => $this->faker->sentence(mt_rand(1, 4)),
            'board_slug' => $this->faker->slug(mt_rand(1, 4))
        ];
    }
}
