<?php

namespace Tests\Unit\Models;

use App\Models\Transaction;
use App\Models\Trip;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_belongs_to_trip(): void
    {
        $transaction = Transaction::factory()->create();
        $this->assertInstanceOf(Trip::class, $transaction->trip);
    }
}
