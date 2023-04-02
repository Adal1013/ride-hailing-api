<?php

namespace App\Http\DataTransferObjects\PaymentSources;

use Spatie\LaravelData\Data;

class PaymentSourceData extends Data
{
  /**
   * @param int $riderId
   * @param string $type
   */
  public function __construct(public int $riderId, public string $type)
  {
  }

  /**
   * @return string[]
   */
  public static function rules(): array
  {
    return [
      'riderId' => 'required|int',
      'type' => 'required|string',
    ];
  }
}
