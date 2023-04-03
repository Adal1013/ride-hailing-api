<?php

namespace Tests\Unit\Models;

use App\Models\PaymentSource;
use App\Models\Transaction;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
  use RefreshDatabase;

  /**
   */
  public function test_belongs_to_payment_source(): void
  {
      $transaction = Transaction::factory()->create();
      $this->assertInstanceOf(PaymentSource::class, $transaction->paymentSource);
  }

  /**
   */
  public function test_belongs_to_trip(): void
  {
      $transaction = Transaction::factory()->create();
      $this->assertInstanceOf(Trip::class, $transaction->trip);
  }
}
