<?php

namespace Tests\Unit\Repositories;

use App\Http\Repositories\Drivers\DriverRepository;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tests\TestCase;

class DriverRepositoryTest extends TestCase
{
  use RefreshDatabase;

  protected DriverRepository $driverRepository;

  /**
   * @return void
   */
  public function setUp(): void
  {
      parent::setUp();
      $this->driverRepository = app(DriverRepository::class);
  }

  /**
   */
  public function test_get_by_id(): void
  {
    $driver = Driver::factory()->create();
    $foundDriver = $this->driverRepository->getById($driver->id);
    $this->assertEquals($driver->email, $foundDriver->email);
  }

  /**
   */
  public function test_get_nearest_driver_to_location(): void
  {
    $driver = Driver::factory()->create();
    Driver::factory(10)->create();
    $location = new Point(
      $driver->current_location->latitude - 1,
      $driver->current_location->longitude - 1
    );
    $foundDriver = $this->driverRepository->getNearestDriverToLocation($location);
    $this->assertEquals($driver->email, $foundDriver->email);
  }

  /**
   */
  public function test_get_driver_distance_from_location(): void
  {
    $driver = Driver::factory()->create();
    $driver->current_location = new Point(0, 0);
    $location = new Point(1, 1);
    $driverDistance = $this->driverRepository->getDriverDistanceFromLocation($driver->id, $location);
    $this->assertEquals(50.515753425878394, $driverDistance->distance_in_meters);
  }
}
