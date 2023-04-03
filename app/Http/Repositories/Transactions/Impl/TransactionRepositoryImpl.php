<?php

namespace App\Http\Repositories\Transactions\Impl;

use App\Helpers\WompiHelper;
use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Http\Repositories\Transactions\TransactionRepository;
use App\Models\Transaction;
use App\Models\Trip;
use Carbon\Carbon;

class TransactionRepositoryImpl implements TransactionRepository
{
  /**
   * @param int $transactionId
   * @return Transaction|null
   */
  public function getById(int $transactionId): Transaction|null
  {
    return Transaction::findOrFail($transactionId);
  }

  /**
   * @param TransactionData $transactionData
   * @return Transaction|null
   */
  public function create(TransactionData $transactionData): Transaction|null
  {
    $requestData = [
      'amount_in_cents' => intval($transactionData->trip->total_cost * 100),
      'currency' => 'COP',
      'customer_email' => $transactionData->trip->rider->email,
      'payment_method' => [ 'installments' => $transactionData->installments],
      'reference' => 'REF' . Carbon::now()->timestamp,
      'payment_source_id' => 51748
    ];
    return $this->createThirdTransaction($requestData, $transactionData->trip);
  }

  /**
   * @param array $requestData
   * @param Trip $trip
   * @return Transaction|null
   */
  private function createThirdTransaction(array $requestData, Trip $trip): Transaction|null
  {
    $responseData = WompiHelper::requestWithAuth('v1/transactions', $requestData, true);
    $data = [
      'amount_in_cents' => $responseData['data']['amount_in_cents'] ?? null,
      'currency' => $responseData['data']['currency'] ?? null,
      'installments' => $responseData['data']['payment_method']['installments'] ?? null,
      'reference' => $responseData['data']['reference'] ?? null,
      'payment_source_id' => $trip->rider->latestPaymentSource->id ?? null,
      'trip_id' => $trip->id,
    ];
    return $this->createTransaction($data);
  }

  /**
   * @param array $data
   * @return Transaction
   */
  public function createTransaction(array $data): Transaction
  {
    return Transaction::create($data);
  }
}
