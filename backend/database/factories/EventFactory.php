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
            'name' => fake()->sentence(),
            'date' => fake()->dateTimeBetween('+1 week', '+2 week'),
            'city' => fake()->city(),
            'type' => fake()->randomElement(['Normal', 'Networking']),
            'location' => fake()->address(),
            'sponsors' => fake()->company() . ', ' . fake()->company(),
        ];
    }
}
