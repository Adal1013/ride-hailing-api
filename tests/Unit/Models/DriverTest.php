<?php

namespace Tests\Unit\Models;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriverTest extends TestCase
{
  use RefreshDatabase;

  /**
   */
  public function test_has_many_trips(): void
  {
      $driver = Driver::factory()->create();
      $this->assertInstanceOf(Collection::class, $driver->trips);
  }
}
