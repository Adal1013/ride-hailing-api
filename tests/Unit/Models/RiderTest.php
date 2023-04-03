<?php

namespace Tests\Unit\Models;

use App\Models\PaymentSource;
use App\Models\Rider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class RiderTest extends TestCase
{
    /**
     */
    public function test_full_name_getter(): void
    {
        $rider = Rider::factory()->create();
        $fullName = $rider->first_name . ' ' . $rider->last_name;
        $this->assertEquals($fullName, $rider->full_name);
    }

    /**
     */
    public function test_has_one_latest_payment_sources(): void
    {
        $rider = Rider::factory()->create();
        $paymentSource = PaymentSource::factory()->create();
        $paymentSource->rider_id = $rider->id;
        $paymentSource->save();
        $this->assertInstanceOf(PaymentSource::class, $rider->latestPaymentSource);
    }

    /**
     */
    public function test_has_many_payment_sources(): void
    {
        $rider = Rider::factory()->create();
        $this->assertInstanceOf(Collection::class, $rider->paymentSources);
    }

    /**
     */
    public function test_has_many_trips(): void
    {
        $rider = Rider::factory()->create();
        $this->assertInstanceOf(Collection::class, $rider->trips);
    }
}
