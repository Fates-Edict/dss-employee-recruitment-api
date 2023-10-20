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
        Schema::dropIfExists('criteria_alternatives');
        Schema::create('criteria_alternatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternative_id')->nullable();
            $table->foreignId('criteria_id')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_alternatives');
    }
};
