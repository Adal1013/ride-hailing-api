<?php

namespace Tests\Unit\Models;

use App\Models\Driver;
use App\Models\PaymentSource;
use App\Models\Transaction;
use App\Models\Trip;
use App\Models\Rider;
use Tests\TestCase;

class TripTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_belongs_to_driver(): void
    {
        $trip = Trip::factory()->create();
        $this->assertInstanceOf(Driver::class, $trip->driver);
    }

    /**
     * A basic unit test example.
     */
    public function test_belongs_to_rider(): void
    {
        $trip = Trip::factory()->create();
        $this->assertInstanceOf(Rider::class, $trip->rider);
    }

    /**
     * A basic unit test example.
     */
    public function test_has_one_transaction(): void
    {
        $trip = Trip::factory()->create();
        $transaction = Transaction::create([
            'amount_in_cents' => 123413131,
            'currency' => 'COP',
            'installments' => 2,
            'reference' => 'PAG1',
            'payment_source_id' => PaymentSource::factory()->create()->id,
            'trip_id' => $trip->id
        ]);
        $this->assertInstanceOf(Transaction::class, $trip->transaction);
    }
}
