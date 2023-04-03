<?php

namespace Tests\Unit\Repositories;

use App\Http\Repositories\Trips\TripRepository;
use App\Models\Driver;
use App\Models\Rider;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tests\TestCase;

class TripRepositoryTest extends TestCase
{
  use RefreshDatabase;

  protected TripRepository $tripRepository;

  /**
   * @return void
   */
  public function setUp(): void
  {
    parent::setUp();
    $this->tripRepository = app(TripRepository::class);
  }

  /**
   */
  public function test_get_by_id(): void
  {
    $trip = Trip::factory()->create();
    $foundTrip = $this->tripRepository->getById($trip->id);
    $this->assertEquals($trip->id, $foundTrip->id);
  }

  /**
   */
  public function test_get_by_driver_id(): void
  {
    $trip = Trip::factory()->create();
    $driver = Driver::factory()->create();
    $trip->status = 'on trip';
    $trip->driver_id = $driver->id;
    $trip->save();
    $foundTrip = $this->tripRepository->getByDriverId($trip->driver_id);
    $this->assertEquals($trip->id, $foundTrip->id);
  }

  /**
   */
  public function test_create(): void
  {
    $trip = $this->generateTrip();
    $this->assertInstanceOf(Trip::class, $trip);
  }

  /**
   */
  public function test_update(): void
  {
    $trip = $this->generateTrip();
    $tripId = $trip->id;
    $data = [
      'id' => $tripId,
      'distance' => 20,
      'duration' => 15,
      'destination_location' => new Point(5, 5),
      'status' => 'finished',
      'total_cost' => 75000
    ];
    $trip = $this->tripRepository->update($data);
    $this->assertEquals($tripId, $trip->id);
    $this->assertInstanceOf(Trip::class, $trip);
  }

  private function generateTrip()
  {
    $driver = Driver::factory()->create();
    $rider = Rider::factory()->create();
    $data = [
      'driver_id' => $driver->id,
      'rider_id' => $rider->id,
      'origin_location' => new Point(1, 1)
    ];
    return $this->tripRepository->create($data);
  }
}
