<?php

namespace App\Http\Services\PaymentSources\Impl;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Http\Repositories\PaymentSources\PaymentSourceRepository;
use App\Http\Repositories\Riders\RiderRepository;
use App\Http\Services\PaymentSources\PaymentSourceService;
use App\Models\PaymentSource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentSourceServiceImpl implements PaymentSourceService
{
  /**
   * @param PaymentSourceRepository $paymentSourceRepository
   * @param RiderRepository $riderRepository
   */
  public function __construct(
      protected PaymentSourceRepository $paymentSourceRepository,
      protected RiderRepository $riderRepository
  )
  {
  }

  /**
   * @param PaymentSourceData $paymentSourceData
   * @return PaymentSource
   */
  public function createMethod(PaymentSourceData $paymentSourceData): PaymentSource
  {
    try {
      $rider = $this->riderRepository->getById($paymentSourceData->riderId);
      DB::beginTransaction();
      $paymentSource = $this->paymentSourceRepository->create($paymentSourceData, $rider);
      DB::commit();
      return $paymentSource;
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Ha ocurrido un error al tratar de crear el metodo de pago para el conductor ' .
        $paymentSourceData->riderId);
      Log::error($e->getMessage());
      abort(500);
    }
  }
}
