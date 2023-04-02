<?php

namespace App\Http\Repositories\Riders\Impl;

use App\Http\Repositories\Riders\RiderRepository;
use App\Models\Rider;

class RiderRepositoryImpl implements RiderRepository
{
  /**
   * @param $riderId
   * @return Rider|null
   */
  public function getById($riderId): Rider|null
  {
    return Rider::findOrFail($riderId);
  }
}
