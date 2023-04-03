<?php

namespace App\Http\Controllers;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Http\Requests\StorePaymentSourceRequest;
use App\Http\Requests\UpdatePaymentSourceRequest;
use App\Http\Resources\PaymentSources\PaymentSourceResource;
use App\Http\Services\PaymentSources\PaymentSourceService;
use App\Models\PaymentSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentSourceController extends Controller
{
  /**
   * @param PaymentSourceService $paymentSourceRepository
   */
    public function __construct(protected PaymentSourceService $paymentSourceRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentSourceRequest $request)
    {
      return $this->createPaymentSource($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeWithSpecificCard(StorePaymentSourceRequest $request)
    {
      $request->merge(['specificCard' => true]);
      return $this->createPaymentSource($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentSource $paymentSource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentSourceRequest $request, PaymentSource $paymentSource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentSource $paymentSource)
    {
        //
    }

    private function createPaymentSource(StorePaymentSourceRequest $request): JsonResponse
    {
      $response = new PaymentSourceResource(
        $this->paymentSourceRepository->createMethod(PaymentSourceData::from($request))
      );
      return $response->response()->setStatusCode(201);
    }
}
