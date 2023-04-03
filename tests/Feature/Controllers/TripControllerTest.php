<?php

namespace Tests\Feature\Controllers;

use App\Enumerations\TripStatusEnum;
use App\Models\Driver;
use App\Models\PaymentSource;
use App\Models\Rider;
use App\Models\Trip;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tests\TestCase;

class TripControllerTest extends TestCase
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
    $driver = Driver::factory()->create();
    $driver->current_location = new Point(1, 1);
    $rider = Rider::factory()->create();
    $requestData = [
      'riderId' => $rider->id,
      'originLatitude' => '2',
      'originLongitude' => '2'
    ];
    $response = $this->post('api/v1/trips', $requestData);
    $modelData = [
      'driver_id' => $driver->id,
      'rider_id' => $rider->id,
      'status' => TripStatusEnum::ON_TRIP->value
    ];
    $response->assertStatus(201);
    $response->assertJsonFragment($modelData);
    $this->assertDatabaseHas('trips', $modelData);
  }

  /**
   */
  public function test_finish_trip(): void
  {
    $driver = Driver::factory()->create();
    $driver->current_location = new Point(1, 1);
    $rider = Rider::factory()->create();
    $paymentSource = PaymentSource::factory()->create();
    $paymentSource->rider_id = $rider->id;
    $paymentSource->save();
    $requestData = [
      'riderId' => $rider->id,
      'originLatitude' => '2',
      'originLongitude' => '2'
    ];
    $trip = $this->post('api/v1/trips', $requestData)->baseResponse->original;
    $requestData = [
      'driverId' => $trip->driver_id,
      'destinationLatitude' => '5',
      'destinationLongitude' => '5',
      'installments' => 3
    ];
    $response = $this->post('api/v1/trips/finish', $requestData);
    $modelData = [
      'currency' => 'COP',
      'installments' => $requestData['installments'],
      'payment_source_id' => $trip->rider->latestPaymentSource->id ?? null,
      'trip_id' => $trip->id,
    ];
    $response->assertStatus(201);
    $response->assertJsonFragment($modelData);
  }
}
