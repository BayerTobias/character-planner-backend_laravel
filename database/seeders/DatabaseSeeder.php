<?php

namespace Database\Seeders;

use Database\Seeders\characters\CharacterClassSeeder;
use Database\Seeders\characters\CharacterRaceSeeder;
use Database\Seeders\items\BaseArmorSeeder;
use Database\Seeders\items\BaseWeaponSeeder;
use Database\Seeders\items\WeaponGroupSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\skills\BardSkillsSeeder;
use Database\Seeders\skills\MageSkillsSeeder;
use Database\Seeders\skills\PriestSkillsSeeder;
use Database\Seeders\skills\RangerSkillsSeeder;
use Database\Seeders\skills\RougeSkillsSeeder;
use Database\Seeders\skills\ShamanSkillsSeeder;
use Database\Seeders\skills\WarriorSkillsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            BaseArmorSeeder::class,
            WeaponGroupSeeder::class,
            BaseWeaponSeeder::class,
            CharacterRaceSeeder::class,
            CharacterClassSeeder::class,
            MageSkillsSeeder::class,
            WarriorSkillsSeeder::class,
            RougeSkillsSeeder::class,
            PriestSkillsSeeder::class,
            BardSkillsSeeder::class,
            RangerSkillsSeeder::class,
            ShamanSkillsSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
