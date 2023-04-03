<?php

namespace Tests\Unit\Repositories;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Http\Repositories\PaymentSources\PaymentSourceRepository;
use App\Models\PaymentSource;
use App\Models\Rider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentSourceRepositoryTest extends TestCase
{
  use RefreshDatabase;

  protected PaymentSourceRepository $paymentSourceRepository;

  /**
   * @return void
   */
  public function setUp(): void
  {
      parent::setUp();
      $this->paymentSourceRepository = app(PaymentSourceRepository::class);
  }

  /**
   */
  public function test_get_test_token(): void
  {
    $token = $this->paymentSourceRepository->getTestToken();
    $configToken = config('app_config.test_token_card');
    $this->assertEquals($token, $configToken);
    $this->assertStringStartsWith('tok', $token);
  }

  /**
   */
  public function test_generate_fake_token(): void
  {
    $rider = Rider::factory()->create();
    $token = $this->paymentSourceRepository->generateFakeToken($rider->full_name);
    $this->assertStringStartsWith('tok', $token);
  }

  /**
   */
  public function test_create(): void
  {
    $rider = Rider::factory()->create();
    $data = PaymentSourceData::from([
      'riderId' => $rider->id,
      'type' => 'CARD'
    ]);
    $paymentSource = $this->paymentSourceRepository->create($data, $rider);
    $this->assertInstanceOf(PaymentSource::class, $paymentSource);
  }
}
