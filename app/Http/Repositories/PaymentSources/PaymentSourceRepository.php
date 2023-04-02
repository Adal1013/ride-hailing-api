<?php

namespace App\Http\Repositories\PaymentSources;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Models\PaymentSource;
use App\Models\Rider;

interface PaymentSourceRepository
{
  /**
   * @return string|null
   */
  public function getTestToken(): string|null;

  /**
   * @return string|null
   */
  public function generateFakeToken(string $riderName): string|null;

  /**
   * @param PaymentSourceData $paymentSourceData
   * @return PaymentSource|null
   */
  public function create(PaymentSourceData $paymentSourceData, Rider $rider): PaymentSource|null;
}
