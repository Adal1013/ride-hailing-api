<?php

namespace App\Http\Resources\Trips;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'driver_id' => $this->driver_id,
          'destination_location' => $this->destination_location,
          'rider_id' => $this->rider_id,
          'origin_location' => $this->origin_location,
          'status' => $this->status,
          "distance" => $this->distance,
          "duration" => $this->duration,
          "total_cost" => $this->total_cost
        ];
    }
}
