<?php

namespace Tests\Unit\Services;

use App\Http\DataTransferObjects\Trips\EndTripData;
use App\Http\DataTransferObjects\Trips\StartTripData;
use App\Http\Services\Trips\TripService;
use App\Models\Driver;
use App\Models\PaymentSource;
use App\Models\Rider;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tests\TestCase;

class TripServiceTest extends TestCase
{
  use RefreshDatabase;

  protected TripService $tripService;

  /**
   * @return void
   */
  public function setUp(): void
  {
    parent::setUp();
    $this->tripService = app(TripService::class);
  }

  /**
   */
  public function test_start_trip(): void
  {
    $trip = $this->startTrip();
    $this->assertInstanceOf(Trip::class, $trip);
  }

  /**
   */
  public function test_finisht_trip(): void
  {
    $trip = $this->startTrip();
    $paymentSource = PaymentSource::factory()->create();
    $paymentSource->rider_id = $trip->rider_id;
    $paymentSource->save();
    $data = EndTripData::from([
      'driverId' => $trip->driver_id,
      'destinationLatitude' => '2',
      'destinationLongitude' => '2',
      'installments' => 3
    ]);
    $responseData = $this->tripService->finishTrip($data);
    $this->assertArrayHasKey('reference', $responseData);
  }

  private function startTrip(): Trip
  {
    $driver = Driver::factory()->create();
    $driver->current_location = new Point(1, 1);
    $rider = Rider::factory()->create();
    $data = StartTripData::from([
      'riderId' => $rider->id,
      'originLatitude' => '1',
      'originLongitude' => '1',
    ]);
    return $this->tripService->startTrip($data);
  }
}
