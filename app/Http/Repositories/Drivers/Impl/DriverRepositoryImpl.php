<?php

namespace App\Http\Repositories\Drivers\Impl;

use App\Http\Repositories\Drivers\DriverRepository;
use App\Models\Driver;
use MatanYadaev\EloquentSpatial\Objects\Point;

class DriverRepositoryImpl implements DriverRepository
{
  /**
   * @param int $driverId
   * @return Driver|null
   */
  public function getById(int $driverId): Driver|null
  {
    return Driver::findOrFail($driverId);
  }

  /**
   * @param Point $location
   * @return Driver|null
   */
  public function getNearestDriverToLocation(Point $location): Driver|null
  {
    return Driver::query()
      ->orderByDistance('current_location', $location, 'desc')
      ->first();
  }

  /**
   * @param int $driverId
   * @param Point $location
   * @return Driver|null
   */
  public function getDriverDistanceFromLocation(int $driverId, Point $location): Driver|null
  {
    return Driver::query()
      ->withDistance('current_location', $location, 'distance_in_meters')
      ->where('id', $driverId)
      ->first();
  }
}
