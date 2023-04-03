<?php

namespace App\Http\Repositories\Drivers;

use App\Models\Driver;
use MatanYadaev\EloquentSpatial\Objects\Point;

interface DriverRepository
{
  /**
   * @param int $driverId
   * @return Driver|null
   */
  public function getById(int $driverId): Driver|null;

  /**
   * @param Point $location
   * @return Driver|null
   */
  public function getNearestDriverToLocation(Point $location): Driver|null;

  /**
   * @param int $driverId
   * @param Point $location
   * @return Driver|null
   */
  public function getDriverDistanceFromLocation(int $driverId, Point $location): Driver|null;
}
