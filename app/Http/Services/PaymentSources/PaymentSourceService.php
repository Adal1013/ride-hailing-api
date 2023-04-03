<?php

namespace App\Http\Services\PaymentSources;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Models\PaymentSource;
use Illuminate\Http\JsonResponse;

interface PaymentSourceService
{
  /**
   * @param PaymentSourceData $paymentSourceData
   * @return JsonResponse|PaymentSource
   */
  public function createMethod(PaymentSourceData $paymentSourceData): JsonResponse|PaymentSource;
}
