<?php

namespace Tests\Unit\Repositories;

use App\Models\Rider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Repositories\Riders\RiderRepository;

class RiderRepositoryTest extends TestCase
{
  use RefreshDatabase;

  protected RiderRepository $riderRepository;

  /**
   * @return void
   */
  public function setUp(): void
  {
      parent::setUp();
      $this->riderRepository = app(RiderRepository::class);
  }

  /**
   */
  public function test_get_by_id(): void
  {
    $rider = Rider::factory()->create();
    $foundRider = $this->riderRepository->getById($rider->id);
    $this->assertEquals($rider->email, $foundRider->email);
  }
}
