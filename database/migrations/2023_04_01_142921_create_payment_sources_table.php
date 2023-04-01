<?php

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
        Schema::create('payment_sources', function (Blueprint $table) {
            $table->id();
            $table->integer('last_four_digits');
            $table->enum('payment_method_type', ['CARD', 'NEQUI']);
            $table->unsignedBigInteger('rider_id');
            $table->unsignedBigInteger('third_party_payment_source_id');
            $table->string('token');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rider_id')->references('id')->on('riders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_sources');
    }
};
