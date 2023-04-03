<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $locations = [
        ['latitude' => 6.258844, 'longitude' => -75.586896],
        ['latitude' => 6.2561953, 'longitude' => -75.6010452],
        ['latitude' => 6.2559065, 'longitude' => -75.6189209],
        ['latitude' => 6.2403579, 'longitude' => -75.5513388],
        ['latitude' => 6.2107613, 'longitude' => -75.5725066],
        ['latitude' => 6.2107613, 'longitude' => -75.5725066],
        ['latitude' => 6.173733, 'longitude' => -75.5833732],
        ['latitude' => 6.1765056, 'longitude' => -75.595268],
        ['latitude' => 6.1765056, 'longitude' => -75.595268],
        ['latitude' => 6.2606786, 'longitude' => -75.5503732],
        ['latitude' => 6.2632937, 'longitude' => -75.5882677]
      ];
      foreach ($locations as $location) {
        Driver::create([
          'first_name' => fake()->firstName,
          'last_name' => fake()->lastName,
          'email' => fake()->lastName,
          'password' => fake()->password,
          'current_location' => new Point($location['latitude'], $location['longitude']),
          'available' => 1
        ]);
      }
    }
}
