<?php

namespace App\Http\Repositories\Riders;

use App\Models\Rider;

interface RiderRepository
{
  /**
   * @param $riderId
   * @return Rider|null
   */
  public function getById($riderId): Rider|null;
}
