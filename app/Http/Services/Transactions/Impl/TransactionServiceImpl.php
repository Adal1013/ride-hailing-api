<?php

namespace App\Http\Services\Transactions\Impl;

use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Http\Repositories\Transactions\TransactionRepository;
use App\Http\Services\Transactions\TransactionService;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionServiceImpl implements TransactionService
{
  /**
   * @param TransactionRepository $transactionRepository
   */
  public function __construct(protected TransactionRepository $transactionRepository)
  {
  }

  /**
   * @param TransactionData $transactionData
   * @return Transaction
   */
  public function createTransaction(TransactionData $transactionData): Transaction
  {
    try {
      DB::beginTransaction();
      $transaction = $this->transactionRepository->create($transactionData);
      DB::commit();
      return $transaction;
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Ha ocurrido un error al tratar de crear una transaccion para el viaje: ' .
        $transactionData->trip->id);
      Log::error($e->getMessage());
      abort(500);
    }
  }
}
