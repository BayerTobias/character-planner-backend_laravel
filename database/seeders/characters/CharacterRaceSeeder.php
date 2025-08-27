<?php

namespace Database\Seeders\characters;

use App\Models\characters\CharacterRace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterRaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CharacterRace::updateOrCreate(
            ['name' => 'Mensch'],
            [
                'strength_modifier' => 0,
                'agility_modifier' => 0,
                'constitution_modifier' => 0,
                'intelligence_modifier' => 0,
                'charisma_modifier' => 0
            ]
        );

        CharacterRace::updateOrCreate(
            ['name' => 'Elf'],
            [
                'strength_modifier' => -1,
                'agility_modifier' => 1,
                'constitution_modifier' => -1,
                'intelligence_modifier' => 0,
                'charisma_modifier' => 1
            ]
        );

        CharacterRace::updateOrCreate(
            ['name' => 'Zwerg'],
            [
                'strength_modifier' => 0,
                'agility_modifier' => -1,
                'constitution_modifier' => 2,
                'intelligence_modifier' => 0,
                'charisma_modifier' => -1
            ]
        );

        CharacterRace::updateOrCreate(
            [
                'name' => 'Halbling'
            ],
            [
                'strength_modifier' => -2,
                'agility_modifier' => 1,
                'constitution_modifier' => 0,
                'intelligence_modifier' => 0,
                'charisma_modifier' => 1
            ]
        );

        CharacterRace::updateOrCreate(
            ['name' => 'Gnom',],
            [
                'strength_modifier' => 0,
                'agility_modifier' => 1,
                'constitution_modifier' => -2,
                'intelligence_modifier' => 1,
                'charisma_modifier' => 0,
            ]
        );
    }
}
