<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount_in_cents' => fake()->randomDigit(),
            'currency' => 'COP',
            'installments' => 2,
            'reference' => fake()->randomElement,
            'trip_id' => Trip::factory()->create()->id
        ];
    }
}
