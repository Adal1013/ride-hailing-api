<?php

namespace App\Http\Repositories\PaymentSources\Impl;

use App\Helpers\WompiHelper;
use App\Http\DataTransferObjects\PaymentSources\PaymentSourceData;
use App\Http\Repositories\PaymentSources\PaymentSourceRepository;
use App\Models\PaymentSource;
use App\Models\Rider;

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
    $responseData = WompiHelper::requestWithAuth('v1/tokens/cards', $requestData);
    return $responseData['data']['id'] ?? null;
  }

  /**
   * @param PaymentSourceData $paymentSourceData
   * @param Rider $rider
   * @return PaymentSource|null
   */
  public function create(PaymentSourceData $paymentSourceData, Rider $rider): PaymentSource|null
  {
    $tokenCard = $paymentSourceData->specificCard ? $this->getTestToken() : $this->generateFakeToken($rider->full_name);
    $requestData = [
      'customer_email' => $rider->email,
      'type' => $paymentSourceData->type,
      'token' => $tokenCard,
      'acceptance_token' => $this->getAcceptanceToken()
    ];
    return $this->createThirdPaymentSource($requestData, $rider->id);
  }

  /**
   * @param array $requestData
   * @param int $riderId
   * @return PaymentSource|null
   */
  private function createThirdPaymentSource(array $requestData, int $riderId): PaymentSource|null
  {
    $responseData = WompiHelper::requestWithAuth('v1/payment_sources', $requestData, true);
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
    $responseData = WompiHelper::request('v1/merchants/');
    return $responseData['data']['presigned_acceptance']['acceptance_token'] ?? null;
  }
}
