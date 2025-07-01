<?php

namespace Database\Seeders\items;

use App\Models\Items\BaseArmor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseArmorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BaseArmor::updateOrCreate(
            ['name' => 'Lederrüstung'],
            [
                'min_str' => 3,
                'armor_bonus' => 1,
                'maneuver_bonus' => 0,
                'weight' => 5.0
            ]
        );
    }
}
