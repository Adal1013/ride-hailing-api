<?php

namespace App\Http\Repositories\Transactions;

use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Models\Transaction;

interface TransactionRepository
{
  /**
   * @param int $transactionId
   * @return Transaction|null
   */
  public function getById(int $transactionId): Transaction|null;

  /**
   * @param TransactionData $transactionData
   * @return Transaction|null
   */
  public function create(TransactionData $transactionData): Transaction|null;
}
