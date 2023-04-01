<?php

namespace Database\Factories;

use App\Models\Rider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentSource>
 */
class PaymentSourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_four_digits' => fake()->randomDigit(4),
            'payment_method_type' => 'CARD',
            'rider_id' => Rider::factory()->create()->id,
            'third_party_payment_source_id' => fake()->randomDigit(4),
            'status' => fake()->boolean,
            'token' => fake()->text(10)
        ];
    }
}
