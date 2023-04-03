<?php

namespace App\Http\DataTransferObjects\Transactions;

use App\Models\Trip;
use Spatie\LaravelData\Data;

class TransactionData extends Data
{
  /**
   * @param Trip $trip
   * @param int $installments
   */
  public function __construct(public Trip $trip, public int $installments)
  {
  }

  /**
   * @return string[]
   */
  public static function rules(): array
  {
    return [
      'trip' => 'required',
      'installments' => 'required|int',
    ];
  }
}
