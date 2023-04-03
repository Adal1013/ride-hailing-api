<?php

namespace App\Http\Controllers;

use App\Http\DataTransferObjects\Trips\EndTripData;
use App\Http\DataTransferObjects\Trips\StartTripData;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\Trips\TripResource;
use App\Http\Services\Transactions\TransactionService;
use App\Http\Services\Trips\TripService;
use App\Models\Trip;

class TripController extends Controller
{
  /**
   * @param TripService $tripService
   * @param TransactionService $transactionService
   */
    public function __construct(protected TripService $tripService, protected TransactionService $transactionService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
      $startTripData = StartTripData::from($request);
      $response = new TripResource(
        $this->tripService->startTrip($startTripData)
      );
      return $response->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }

    /**
     * finish a trip
     */
    public function finishTrip(UpdateTripRequest $request)
    {
      $response = $this->tripService->finishTrip(EndTripData::from($request));
      return response()->json($response, 201);
    }
}
