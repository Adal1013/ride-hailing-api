<?php

namespace Tests\Unit\Models;

use App\Models\Driver;
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
}
