<?php

namespace App\Http\Repositories\Riders;

use App\Models\Rider;

interface RiderRepository
{
  /**
   * @param int $riderId
   * @return Rider|null
   */
  public function getById(int $riderId): Rider|null;
}
