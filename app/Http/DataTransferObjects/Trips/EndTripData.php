<?php

namespace App\Http\DataTransferObjects\Trips;

use Spatie\LaravelData\Data;

class EndTripData extends Data
{
  /**
   * @param int $driverId
   * @param string $destinationLatitude
   * @param string $destinationLongitude
   * @param int $installments
   */
  public function __construct(
      public int $driverId,
      public string $destinationLatitude,
      public string $destinationLongitude,
      public int $installments
  )
  {
  }

  /**
   * @return string[]
   */
  public static function rules(): array
  {
    return [
      'driverId' => 'required|int',
      'destinationLatitude' => 'required|string',
      'destinationLongitude' => 'required|string',
      'installments' => 'required|int'
    ];
  }
}
