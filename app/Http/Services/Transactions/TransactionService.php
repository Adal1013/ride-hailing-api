<?php

namespace App\Http\Services\Transactions;

use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Models\Transaction;

interface TransactionService
{
  /**
   * @param TransactionData $transactionData
   * @return Transaction
   */
  public function createTransaction(TransactionData $transactionData): Transaction;
}
