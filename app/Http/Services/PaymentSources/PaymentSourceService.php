<?php

namespace App\Http\Services\PaymentSources;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Models\PaymentSource;

interface PaymentSourceService
{
  /**
   * @param PaymentSourceData $paymentSourceData
   * @return PaymentSource
   */
  public function createMethod(PaymentSourceData $paymentSourceData): PaymentSource;
}
