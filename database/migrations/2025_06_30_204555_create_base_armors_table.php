<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('base_armors', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
            $table->integer('min_str')->nullable();
            $table->integer('armor_bonus')->nullable();
            $table->integer('maneuver_bonus')->nullable();
            $table->decimal('weight', 5, 1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_armors');
    }
};
