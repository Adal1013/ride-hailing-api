<?php

namespace App\Http\Repositories\PaymentSources\Impl;

use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Http\Repositories\PaymentSources\PaymentSourceRepository;
use App\Models\PaymentSource;
use App\Models\Rider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentSourceRepositoryImpl implements PaymentSourceRepository
{
  /**
   * @return string|null
   */
  public function getTestToken(): string|null
  {
    return config('app_config.test_token_card');
  }

  /**
   * @param string $riderName
   * @return string|null
   */
  public function generateFakeToken(string $riderName): string|null
  {
    $requestData = [
      "number" => '4242424242424242',
      "exp_month" => "06",
      "exp_year" => "29",
      "cvc" => "123",
      "card_holder" => $riderName
    ];
    $response = Http::withToken(config('app_config.wompi_public_key'))
      ->post(config('app_config.wompi_url') . 'v1/tokens/cards', $requestData);
    if ($response->successful()) {
      $responseData = $response->json();
      return $responseData['data']['id'] ?? null;
    }
    if ($response->failed() || $response->serverError()) {
      Log::error("Error generando un token falso");
      Log::error($response->json());
      Log::error($response->failed());
      Log::error($response->serverError());
    }
    return null;
  }

  /**
   * @param PaymentSourceData $paymentSourceData
   * @return PaymentSource|null
   */
  public function create(PaymentSourceData $paymentSourceData, Rider $rider): PaymentSource|null
  {
    $requestData = [
      'customer_email' => $rider->email,
      'type' => $paymentSourceData->type,
      //'token' => $this->getTestToken(),
      'token' => $this->generateFakeToken($rider->full_name),
      'acceptance_token' => $this->getAcceptanceToken()
    ];
    return $this->createThirdPaymentSource($requestData, $rider->id);
  }

  /**
   * @param array $data
   * @return PaymentSource|null
   */
  private function createThirdPaymentSource(array $requestData, int $riderId): PaymentSource|null
  {
    $response = Http::withToken(config('app_config.wompi_private_key'))
      ->post(config('app_config.wompi_url') . 'v1/payment_sources', $requestData);
    if ($response->successful()) {
      $responseData = $response->json();
      $data = [
        'last_four_digits' => $responseData['data']['public_data']['last_four'] ?? null,
        'payment_method_type' => $responseData['data']['type'] ?? $requestData['type'],
        'rider_id' => $riderId,
        'third_party_payment_source_id' => $responseData['data']['id'] ?? null,
        'status' => $responseData['data']['status'] === 'AVAILABLE' ? 1 : 0,
        'token' => $responseData['data']['token'] ?? $requestData['token']
      ];
      return $this->createPaymentSource($data);
    }
    if ($response->failed() || $response->serverError()) {
      Log::error("Error creando un metodo de pago");
      Log::error($response->json());
      Log::error($response->failed());
      Log::error($response->serverError());
    }
    return null;
  }

  /**
   * @param array $data
   * @return PaymentSource
   */
  private function createPaymentSource(array $data): PaymentSource
  {
    return PaymentSource::create($data);
  }

  /**
   * @return string|null
   */
  private function getAcceptanceToken(): string|null
  {
    $response = Http::get(config('app_config.wompi_url') . 'v1/merchants/' . config('app_config.wompi_public_key'));
    if ($response->successful()) {
      $responseData = $response->json();
      return $responseData['data']['presigned_acceptance']['acceptance_token'] ?? null;
    }
    if ($response->failed() || $response->serverError()) {
      Log::error("Error obteniendo un token de aceptación");
      Log::error($response->json());
      Log::error($response->failed());
      Log::error($response->serverError());
    }
    return null;
  }
}
