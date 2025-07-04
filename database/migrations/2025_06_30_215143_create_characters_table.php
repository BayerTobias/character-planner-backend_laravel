<?php

use App\Models\characters\CharacterClass;
use App\Models\characters\CharacterRace;
use App\Models\Items\BaseArmor;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);

            $table->foreignIdFor(CharacterRace::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(CharacterClass::class)->nullable()->constrained()->nullOnDelete();

            $table->integer('max_hp')->default(0);
            $table->integer('current_hp')->default(0);
            $table->integer('max_mana')->nullable();
            $table->integer('current_mana')->nullable();

            $table->integer('strength_value');
            $table->integer('strength_bonus');
            $table->integer('agility_value');
            $table->integer('agility_bonus');
            $table->integer('constitution_value');
            $table->integer('constitution_bonus');
            $table->integer('intelligence_value');
            $table->integer('intelligence_bonus');
            $table->integer('charisma_value');
            $table->integer('charisma_bonus');

            $table->foreignIdFor(BaseArmor::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
