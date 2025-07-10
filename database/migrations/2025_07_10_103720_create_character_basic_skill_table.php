<?php

use App\Models\characters\Character;
use App\Models\skills\BasicSkill;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('character_basic_skill', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Character::class)->constrained()->onDelete('cascade');

            $table->foreignIdFor(BasicSkill::class)->constrained()->onDelete('cascade');

            $table->integer('nodes_skilled')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_basic_skill');
    }
};
