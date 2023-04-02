<?php

namespace Tests\Unit\Services;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Http\Services\PaymentSources\PaymentSourceService;
use App\Models\PaymentSource;
use App\Models\Rider;
use Tests\TestCase;

class PaymentSourceServiceTest extends TestCase
{
  protected PaymentSourceService $paymentSourceService;

  /**
   * @return void
   */
  public function setUp(): void
  {
    parent::setUp();
    $this->paymentSourceService = app(PaymentSourceService::class);
  }

  /**
   */
  public function test_create_method(): void
  {
    $rider = Rider::factory()->create();
    $data = PaymentSourceData::from([
      'riderId' => $rider->id,
      'type' => 'CARD'
    ]);
    $paymentSource = $this->paymentSourceService->createMethod($data);
    $this->assertInstanceOf(PaymentSource::class, $paymentSource);
  }
}
