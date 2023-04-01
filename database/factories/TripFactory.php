<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Rider;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'distance' => fake()->randomFloat(2, 100, 999),
            'duration' => fake()->randomFloat(2, 100, 999),
            'driver_id' => Driver::factory()->create()->id,
            'destination_location' => new Point(fake()->latitude, fake()->longitude),
            'rider_id' => Rider::factory()->create()->id,
            'origin_location' => new Point(fake()->latitude, fake()->longitude),
            'status' => fake()->randomElement(['on trip', 'canceled', 'finished']),
            'total_cost' => fake()->randomFloat(3, 2)
        ];
    }
}
