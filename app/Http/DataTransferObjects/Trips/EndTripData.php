<?php

namespace App\Http\DataTransferObjects\Trips;

use Spatie\LaravelData\Data;

class EndTripData extends Data
{
  /**
   * @param int $driverId
   * @param int $destinationLatitude
   * @param int $destinationLongitude
   * @param int $installments
   */
  public function __construct(
      public int $driverId,
      public int $destinationLatitude,
      public int $destinationLongitude,
      public int $installments
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
      'installments' => $intRule
    ];
  }
}
