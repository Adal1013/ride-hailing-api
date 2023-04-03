<?php

namespace App\Helpers;

use App\Models\Transaction;

class TransactionHelper
{
  private const PREFIX = 'REF';

  /**
   * @return string
   */
  public static function generateReference(): string
  {
    $lastReference = Transaction::max('reference');
    $nextReference = ($lastReference + 1) ?? 1;
    return self::PREFIX . str_pad($nextReference, 19 - strlen(self::PREFIX), '0', STR_PAD_LEFT);
  }
}
