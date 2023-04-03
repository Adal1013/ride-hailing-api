<?php

namespace App\Http\Repositories\Trips;

use App\Models\Trip;

interface TripRepository
{
  /**
   * @param int $tripId
   * @return Trip|null
   */
  public function getById(int $tripId): Trip|null;

  /**
   * @param int $driverId
   * @return Trip|null
   */
  public function getByDriverId(int $driverId): Trip|null;

  /**
   * @param array $data
   * @return Trip|null
   */
  public function create(array $data): Trip|null;

  /**
   * @param array $data
   * @return Trip|null
   */
  public function update(array $data): Trip|null;
}
