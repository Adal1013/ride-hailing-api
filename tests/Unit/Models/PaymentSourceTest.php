<?php

namespace Tests\Unit\Models;

use App\Models\PaymentSource;
use App\Models\Rider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentSourceTest extends TestCase
{
  use RefreshDatabase;

  /**
   */
  public function test_belongs_to_rider(): void
  {
      $paymentSource = PaymentSource::factory()->create();
      $this->assertInstanceOf(Rider::class, $paymentSource->rider);
  }
}
