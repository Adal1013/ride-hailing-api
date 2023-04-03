<?php

namespace App\Http\DataTransferObjects\Trips;

use Spatie\LaravelData\Data;

class EndTripData extends Data
{
  /**
   * @param int $driverId
   * @param string $destinationLatitude
   * @param string $destinationLongitude
   */
  public function __construct(
      public int $driverId,
      public string $destinationLatitude,
      public string $destinationLongitude
  )
  {
  }

  /**
   * @return string[]
   */
  public static function rules(): array
  {
    $intRule = 'required|int';
    return [
      'driverId' => $intRule,
      'destinationLatitude' => $intRule,
      'destinationLongitude' => $intRule,
    ];
  }
}
