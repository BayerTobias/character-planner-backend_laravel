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
        Schema::create('money', function (Blueprint $table) {
            $table->id();

            $table->integer('gf')->default(0);
            $table->integer('tt')->default(0);
            $table->integer('kl')->default(0);
            $table->integer('mu')->default(0);

            $table->foreignIdFor(Character::class)
                ->unique()
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money');
    }
};
