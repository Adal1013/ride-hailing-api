<?php

namespace Tests\Unit\Models;

use App\Models\Rider;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class RiderTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_has_many_payment_sources(): void
    {
        $rider = Rider::factory()->create();
        $this->assertInstanceOf(Collection::class, $rider->paymentSources);
    }

    /**
     * A basic unit test example.
     */
    public function test_has_many_trips(): void
    {
        $rider = Rider::factory()->create();
        $this->assertInstanceOf(Collection::class, $rider->trips);
    }
}
