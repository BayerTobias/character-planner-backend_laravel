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
                'weight' => 10.0,
                'type' => 'armor'
            ]
        );

        BaseArmor::updateOrCreate(
            ['name' => 'Kettenhemd'],
            [
                'min_str' => 4,
                'armor_bonus' => 2,
                'maneuver_bonus' => -1,
                'weight' => 15.0,
                'type' => 'armor'
            ]
        );

        BaseArmor::updateOrCreate(
            ['name' => 'Halbe-Platte'],
            [
                'min_str' => 5,
                'armor_bonus' => 3,
                'maneuver_bonus' => -2,
                'weight' => 18.0,
                'type' => 'armor'
            ]
        );

        BaseArmor::updateOrCreate(
            ['name' => 'Plattenpanzer'],
            [
                'min_str' => 6,
                'armor_bonus' => 4,
                'maneuver_bonus' => -3,
                'weight' => 30.0,
                'type' => 'armor'
            ]
        );

        BaseArmor::updateOrCreate(
            ['name' => 'Ritterrüstung'],
            [
                'min_str' => 7,
                'armor_bonus' => 5,
                'maneuver_bonus' => -4,
                'weight' => 40.0,
                'type' => 'armor'
            ]
        );

        BaseArmor::updateOrCreate(
            ['name' => 'Schild'],
            [
                'min_str' => 3,
                'armor_bonus' => 1,
                'maneuver_bonus' => 0,
                'weight' => 5.0,
                'type' => 'shield'
            ]
        );

        BaseArmor::updateOrCreate(
            ['name' => 'Turmschild'],
            [
                'min_str' => 4,
                'armor_bonus' => 2,
                'maneuver_bonus' => -1,
                'weight' => 10.0,
                'type' => 'shield'
            ]
        );
    }
}
