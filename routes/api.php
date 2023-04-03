<?php

use App\Http\Controllers\PaymentSourceController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
  Route::group(['prefix' => 'payment-sources'], function () {
    Route::post('', [PaymentSourceController::class, 'store']);
  });
  Route::group(['prefix' => 'trips'], function () {
    Route::post('', [TripController::class, 'store']);
    Route::post('finish', [TripController::class, 'finishTrip']);
  });
});
