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
    $lastReference = Transaction::orderBy('id', 'desc')->first()->id ?? 1;
    return self::PREFIX . str_pad(($lastReference + 1), 10 - strlen(self::PREFIX), '0', STR_PAD_LEFT);
  }
}
