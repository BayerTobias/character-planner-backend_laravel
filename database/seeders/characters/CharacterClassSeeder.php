<?php

namespace Database\Seeders\characters;

use App\Models\characters\CharacterClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CharacterClass::updateOrCreate([
            'name' => 'mage',
            'base_lvl_hp' => '4',
            'base_lvl_mana' => '3',
            'main_stat' => 'intelligence',
            'color' => 'rgb(88, 169, 227)'
        ]);

        CharacterClass::updateOrCreate([
            'name' => 'warrior',
            'base_lvl_hp' => '10',
            'base_lvl_mana' => null,
            'main_stat' => 'strength',
            'color' => 'rgba(128, 90, 37, 1)'
        ]);

        CharacterClass::updateOrCreate([
            'name' => 'rouge',
            'base_lvl_hp' => '6',
            'base_lvl_mana' => null,
            'main_stat' => 'agility',
            'color' => 'rgba(191, 63, 63, 1)'
        ]);

        CharacterClass::updateOrCreate([
            'name' => 'priest',
            'base_lvl_hp' => '8',
            'base_lvl_mana' => '3',
            'main_stat' => 'charisma',
            'color' => 'rgba(169, 169, 169, 1)'
        ]);

        CharacterClass::updateOrCreate([
            'name' => 'bard',
            'base_lvl_hp' => '6',
            'base_lvl_mana' => '3',
            'main_stat' => 'charisma',
            'color' => 'rgba(238, 189, 83, 1)'
        ]);

        CharacterClass::updateOrCreate([
            'name' => 'ranger',
            'base_lvl_hp' => '8',
            'base_lvl_mana' => '3',
            'main_stat' => 'agility',
            'color' => 'rgba(122, 191, 105, 1)'
        ]);

        CharacterClass::updateOrCreate([
            'name' => 'shaman',
            'base_lvl_hp' => '6',
            'base_lvl_mana' => '3',
            'main_stat' => 'intelligence',
            'color' => 'rgba(130, 91, 221, 1)'
        ]);
    }
}
