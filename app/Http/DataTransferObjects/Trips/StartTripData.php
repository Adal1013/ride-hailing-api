<?php

namespace App\Http\DataTransferObjects\Trips;

use Spatie\LaravelData\Data;

class StartTripData extends Data
{
  /**
   * @param int $riderId
   * @param string $originLatitude
   * @param string $originLongitude
   */
  public function __construct(public int $riderId, public string $originLatitude, public string $originLongitude)
  {
  }

  /**
   * @return string[]
   */
  public static function rules(): array
  {
    $intRule = 'required|int';
    return [
      'riderId' => $intRule,
      'originLatitude' => $intRule,
      'originLongitude' => $intRule,
    ];
  }
}
