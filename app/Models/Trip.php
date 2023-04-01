<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'distance',
        'duration',
        'driver_id',
        'destination_location',
        'rider_id',
        'origin_location',
        'status',
        'total_cost'
    ];
}
