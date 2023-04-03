<?php

namespace Tests\Unit\Helpers;

use App\Exceptions\WompiException;
use App\Helpers\WompiHelper;
use Tests\TestCase;

class WompiHelperTest extends TestCase
{
  /**
   */
  public function test_request(): void
  {
    $wompiResponse = WompiHelper::request('v1/merchants/');
    $this->assertArrayHasKey('data', $wompiResponse);
    $this->assertArrayHasKey('name', $wompiResponse['data']);
    $this->assertArrayHasKey('email', $wompiResponse['data']);
    $this->assertArrayHasKey('public_key', $wompiResponse['data']);
  }

  /**
   */
  public function test_fail_request(): void
  {
    $this->expectException(WompiException::class);
    WompiHelper::request('v1/failed/');
  }

  /**
   */
  public function test_request_with_auth(): void
  {
    $requestData = [
      "number" => '4242424242424242',
      "exp_month" => "06",
      "exp_year" => "29",
      "cvc" => "123",
      "card_holder" => 'Pedro Perez'
    ];
    $wompiResponse = WompiHelper::requestWithAuth('v1/tokens/cards', $requestData);
    $this->assertArrayHasKey('data', $wompiResponse);
    $this->assertArrayHasKey('status', $wompiResponse);
    $this->assertArrayHasKey('id', $wompiResponse['data']);
    $this->assertArrayHasKey('last_four', $wompiResponse['data']);
    $this->assertArrayHasKey('validity_ends_at', $wompiResponse['data']);
    $this->assertEquals('CREATED', $wompiResponse['status']);
  }
}
