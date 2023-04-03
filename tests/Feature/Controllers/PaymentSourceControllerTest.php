<?php

namespace Tests\Feature\Controllers;

use App\Models\Rider;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentSourceControllerTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->withoutMiddleware(VerifyCsrfToken::class);
  }

  /**
   */
  public function test_store(): void
  {
    $rider = Rider::factory()->create();
    $requestData = [
      'riderId' => $rider->id,
      'type' => 'CARD'
    ];
    $response = $this->post('api/v1/payment-sources', $requestData);
    $modelData = [
      'rider_id' => $rider->id,
      'payment_method_type' => 'CARD'
    ];
    $response->assertStatus(201);
    $response->assertJsonFragment($modelData);
    $this->assertDatabaseHas('payment_sources', $modelData);
  }

  /**
   */
  public function test_store_with_specific_card(): void
  {
    $rider = Rider::factory()->create();
    $requestData = [
      'riderId' => $rider->id,
      'type' => 'CARD'
    ];
    $response = $this->post('api/v1/payment-sources/with-card', $requestData);
    $modelData = [
      'rider_id' => $rider->id,
      'payment_method_type' => 'CARD'
    ];
    $response->assertStatus(201);
    $response->assertJsonFragment($modelData);
    $this->assertDatabaseHas('payment_sources', $modelData);
  }
}
