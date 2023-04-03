<?php

namespace App\Http\Resources\PaymentSources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentSourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "rider_id" => $this->rider_id,
          "third_party_payment_source_id" => $this->third_party_payment_source_id,
          "last_four_digits" => $this->last_four_digits,
          "payment_method_type" => $this->payment_method_type,
          "status" => $this->status
        ];
    }
}
