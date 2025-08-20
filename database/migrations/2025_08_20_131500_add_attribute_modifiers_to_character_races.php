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
        Schema::table('character_races', function (Blueprint $table) {
            $table->integer('strength_modifier')->default(0);
            $table->integer('agility_modifier')->default(0);
            $table->integer('constitution_modifier')->default(0);
            $table->integer('intelligence_modifier')->default(0);
            $table->integer('charisma_modifier')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('character_races', function (Blueprint $table) {
            $table->dropColumn([
                'strength_modifier',
                'agility_modifier',
                'constitution_modifier',
                'intelligence_modifier',
                'charisma_modifier',
            ]);
        });
    }
};
