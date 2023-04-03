<?php

namespace App\Http\Services\Trips;

use App\Http\DataTransferObjects\Trips\EndTripData;
use App\Http\DataTransferObjects\Trips\StartTripData;
use App\Models\Trip;

interface TripService
{
  /**
   * @param StartTripData $tripData
   * @return Trip
   */
  public function startTrip(StartTripData $tripData): Trip;

  /**
   * @param EndTripData $tripData
   * @return array
   */
  public function finishTrip(EndTripData $tripData): array;
}
