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
        CharacterRace::updateOrCreate([
            'name' => 'Mensch'
        ]);

        CharacterRace::updateOrCreate([
            'name' => 'Elf'
        ]);

        CharacterRace::updateOrCreate([
            'name' => 'Zwerg'
        ]);

        CharacterRace::updateOrCreate([
            'name' => 'Halbling'
        ]);

        CharacterRace::updateOrCreate([
            'name' => 'Gnom'
        ]);
    }
}
