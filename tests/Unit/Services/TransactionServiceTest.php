<?php

namespace Tests\Unit\Services;

use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Http\Services\Transactions\TransactionService;
use App\Models\PaymentSource;
use App\Models\Transaction;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
  use RefreshDatabase;

  protected TransactionService $transactionService;

  /**
   * @return void
   */
  public function setUp(): void
  {
    parent::setUp();
    $this->transactionService = app(TransactionService::class);
  }

  /**
   */
  public function test_create_transaction(): void
  {
    $trip = Trip::factory()->create();
    $paymentSource = PaymentSource::factory()->create();
    $paymentSource->rider_id = $trip->rider_id;
    $paymentSource->save();
    $data = TransactionData::from([
      'trip' => $trip,
      'installments' => '2'
    ]);
    $transaction = $this->transactionService->createTransaction($data);
    $this->assertInstanceOf(Transaction::class, $transaction);
  }
}
