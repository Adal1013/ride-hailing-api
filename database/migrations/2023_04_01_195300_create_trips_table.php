<?php

use App\Enumerations\TripStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->decimal('distance', 10, 2)->nullable();
            $table->decimal('duration', 10, 2)->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->point('destination_location')->nullable();
            $table->unsignedBigInteger('rider_id');
            $table->point('origin_location');
            $table->enum('status', TripStatusEnum::getValues())->default(TripStatusEnum::ON_TRIP->value);
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('rider_id')->references('id')->on('riders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
