<?php

namespace App\Http\Services\Trips\Impl;

use App\Enumerations\TripStatusEnum;
use App\Exceptions\WompiException;
use App\Http\DataTransferObjects\Transactions\TransactionData;
use App\Http\DataTransferObjects\Trips\EndTripData;
use App\Http\DataTransferObjects\Trips\StartTripData;
use App\Http\Repositories\Drivers\DriverRepository;
use App\Http\Repositories\Riders\RiderRepository;
use App\Http\Repositories\Trips\TripRepository;
use App\Http\Services\Transactions\TransactionService;
use App\Http\Services\Trips\TripService;
use App\Models\Trip;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MatanYadaev\EloquentSpatial\Objects\Point;

class TripServiceImpl implements TripService
{
  /**
   * @param DriverRepository $driverRepository
   * @param RiderRepository $riderRepository
   * @param TripRepository $tripRepository
   * @param TransactionService $transactionService
   */
  public function __construct(
      protected DriverRepository $driverRepository,
      protected RiderRepository $riderRepository,
      protected TripRepository $tripRepository,
      protected TransactionService $transactionService
  )
  {
  }

  /**
   * @param StartTripData $tripData
   * @return Trip
   */
  public function startTrip(StartTripData $tripData): Trip
  {
    try {
      $rider = $this->riderRepository->getById($tripData->riderId);
      if (isset($rider->trips)) {
        $tripStatus = $rider->trips()->latest()->first()->status ?? null;
        if ($tripStatus === TripStatusEnum::ON_TRIP->value) {
          throw new WompiException('El pasajero ya se encuenta en viaje', 403);
        }
      }
      $riderLocation = new Point($tripData->originLatitude, $tripData->originLongitude);
      $driver = $this->driverRepository->getNearestDriverToLocation($riderLocation);
      if (!isset($driver)) {
        throw new WompiException('No hay conductores disponibles', 403);
      }
      DB::beginTransaction();
      $data = [
        'driver_id' => $driver->id,
        'rider_id' => $rider->id,
        'origin_location' => $riderLocation
      ];
      $trip = $this->tripRepository->create($data);
      DB::commit();
      return $this->tripRepository->getById($trip->id);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Ha ocurrido un error al iniciar un viaje para el rider: ' . $tripData->riderId);
      Log::error($e->getMessage());
      abort(403, $e->getMessage());
    }
  }

  /**
   * @param EndTripData $tripData
   * @return array
   */
  public function finishTrip(EndTripData $tripData): array
  {
    try {
      $finalLocation = new Point($tripData->destinationLatitude, $tripData->destinationLongitude);
      $driver = $this->driverRepository->getDriverDistanceFromLocation($tripData->driverId, $finalLocation);
      $trip = $this->tripRepository->getByDriverId($driver->id);
      if (!isset($trip)) {
        throw new WompiException('Este viaje ya fue finalizado', 403);
      }
      $date = Carbon::now();
      $durationInMin = $date->diffInMinutes($trip->created_at);
      $distanceInKm = $driver->distance_in_meters / 1000;
      DB::beginTransaction();
      $data = [
        'id' => $trip->id,
        'distance' => $distanceInKm,
        'duration' => $durationInMin,
        'destination_location' => $finalLocation,
        'status' => TripStatusEnum::FINISHED->value,
        'total_cost' => 3500 + ($distanceInKm * 1000) + ($durationInMin * 200)
      ];
      $trip = $this->tripRepository->update($data);
      $data = [
        'trip' => $trip,
        'installments' =>  $tripData->installments
      ];
      $transaction = $this->transactionService
        ->createTransaction(TransactionData::from($data));
      DB::commit();
      return [
        'distance' => $trip->distance,
        'duration' => $trip->duration,
        'status' => $trip->status,
        'total_cost' => $trip->total_cost,
        'amount_in_cents' => $transaction->amount_in_cents,
        'currency' => $transaction->currency,
        'installments' => $transaction->installments,
        'reference' => $transaction->reference,
        'payment_source_id' => $transaction->payment_source_id,
        'trip_id' => $transaction->trip_id,
      ];
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Ha ocurrido un error al finalizar un viaje para el driver: ' . $tripData->driverId);
      Log::error($e->getMessage());
      abort(403, $e->getMessage());
    }
  }
}
