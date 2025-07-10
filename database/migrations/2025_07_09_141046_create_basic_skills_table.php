<?php

use App\Models\characters\CharacterClass;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basic_skills', function (Blueprint $table) {
            $table->id();

            $table->string('name', 25);
            $table->string('description', 300);
            $table->integer('first_level_cost')->default(1);
            $table->integer('second_level_cost')->nullable();
            $table->foreignIdFor(CharacterClass::class)
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_skills');
    }
};
