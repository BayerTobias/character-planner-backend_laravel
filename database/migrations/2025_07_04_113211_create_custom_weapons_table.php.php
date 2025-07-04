<?php

use App\Models\characters\Character;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_weapons', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
            $table->integer('min_str')->nullable();
            $table->integer('dmg')->default(0);
            $table->string('attribute', 5)->nullable();
            $table->decimal('weight', 5, 1)->nullable();
            $table->integer('ini_bonus')->default(0);
            $table->string('special', 250)->nullable();

            $table->foreignIdFor(Character::class)->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_weapons');
    }
};
