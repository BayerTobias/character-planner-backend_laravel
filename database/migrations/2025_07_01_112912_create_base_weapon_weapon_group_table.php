<?php

use App\Models\Items\BaseWeapon;
use App\Models\Items\WeaponGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('base_weapon_weapon_group', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(BaseWeapon::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(WeaponGroup::class)->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_weapon_weapon_group');
    }
};
