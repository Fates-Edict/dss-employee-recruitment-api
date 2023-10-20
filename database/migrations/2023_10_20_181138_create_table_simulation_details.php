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
        Schema::dropIfExists('simulation_details');
        Schema::create('simulation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulation_id')->nullable();
            $table->foreignId('alternative_id')->nullable();
            $table->double('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_details');
    }
};
