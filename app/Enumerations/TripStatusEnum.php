<?php

namespace App\Enumerations;

enum TripStatusEnum: string
{
    case CANCELED = 'CAN';
    case ON_TRIP = 'ONT';
    case FINISHED = 'FIS';

    /**
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::CANCELED => 'canceled',
            self::ON_TRIP => 'on trip',
            self::FINISHED => 'finished'
        };
    }

    /**
     * @return array
     */
    public static function getValues(): array
    {
      $result = [];
      foreach (self::cases() as $status) {
        $result[] = $status->value;
      }
      return $result;
    }
}
