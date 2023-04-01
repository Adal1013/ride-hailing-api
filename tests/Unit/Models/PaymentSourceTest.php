<?php

namespace Tests\Unit\Models;

use App\Models\PaymentSource;
use App\Models\Rider;
use Tests\TestCase;

class PaymentSourceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_belongs_to_rider(): void
    {
        $paymentSource = PaymentSource::factory()->create();
        $this->assertInstanceOf(Rider::class, $paymentSource->rider);
    }
}
