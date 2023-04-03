<?php

namespace App\Http\Repositories\Trips\Impl;

use App\Enumerations\TripStatusEnum;
use App\Http\Repositories\Trips\TripRepository;
use App\Models\Trip;

class TripRepositoryImpl implements TripRepository
{
  /**
   * @param int $tripId
   * @return Trip|null
   */
  public function getById(int $tripId): Trip|null
  {
    return Trip::findOrFail($tripId);
  }

  /**
   * @param int $driverId
   * @return Trip|null
   */
  public function getByDriverId(int $driverId): Trip|null
  {
    return Trip::where('driver_id', $driverId)
      ->where('status', TripStatusEnum::ON_TRIP->value)
      ->latest()
      ->first();
  }

  /**
   * @param array $data
   * @return Trip|null
   */
  public function create(array $data): Trip|null
  {

    return Trip::create($data);
  }

  /**
   * @param array $data
   * @return Trip|null
   */
  public function update(array $data): Trip|null
  {
    return Trip::updateOrCreate(['id' => $data['id']], $data);
  }
}
