<?php

namespace Tests\Unit\Repositories;

use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Http\Repositories\Transactions\TransactionRepository;
use App\Models\PaymentSource;
use App\Models\Transaction;
use App\Models\Trip;
use Tests\TestCase;

class TransactionRepositoryTest extends TestCase
{
  protected TransactionRepository $transactionRepository;

  /**
   * @return void
   */
  public function setUp(): void
  {
    parent::setUp();
    $this->transactionRepository = app(TransactionRepository::class);
  }

  /**
   */
  public function test_get_by_id(): void
  {
    $transaction = Transaction::factory()->create();
    $foundTransaction = $this->transactionRepository->getById($transaction->id);
    $this->assertEquals($transaction->id, $foundTransaction->id);
  }

  /**
   */
  public function test_create(): void
  {
    $trip = Trip::factory()->create();
    $paymentSource = PaymentSource::factory()->create();
    $paymentSource->rider_id = $trip->rider_id;
    $paymentSource->save();
    $data = TransactionData::from([
      'trip' => $trip,
      'installments' => '2'
    ]);
    $transaction = $this->transactionRepository->create($data);
    $this->assertInstanceOf(Transaction::class, $transaction);
  }
}
