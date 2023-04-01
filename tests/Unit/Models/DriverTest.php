<?php

namespace Tests\Unit\Models;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class DriverTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_has_many_trips(): void
    {
        $driver = Driver::factory()->create();
        $this->assertInstanceOf(Collection::class, $driver->trips);
    }
}
