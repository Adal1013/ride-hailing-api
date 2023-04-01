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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount_in_cents');
            $table->string('currency')->default('COP');
            $table->integer('installments')->nullable();
            $table->string('reference');
            $table->unsignedBigInteger('payment_source_id');
            $table->unsignedBigInteger('trip_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('payment_source_id')->references('id')->on('payment_sources');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
