<?php

namespace Tests\Unit\Helpers;

use App\Helpers\TransactionHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionHelperTest extends TestCase
{
  use RefreshDatabase;

  /**
   */
  public function test_generate_reference(): void
  {
    $reference = TransactionHelper::generateReference();
    $this->assertStringStartsWith('REF', $reference);
    $this->assertEquals('REF0000002', $reference);
  }
}
