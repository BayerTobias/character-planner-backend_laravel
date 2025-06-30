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
        Schema::create('character_classes', function (Blueprint $table) {
            $table->id();

            $table->string('name', 25);
            $table->integer('base_lvl_hp')->default(1);
            $table->integer('base_lvl_mana')->nullable();
            $table->enum('main_stat', ['strength', 'agility', 'constitution', 'intelligence', 'charisma',]);
            $table->string('color', 25);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_classes');
    }
};
