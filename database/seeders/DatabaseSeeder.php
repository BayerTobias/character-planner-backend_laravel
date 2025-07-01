<?php

namespace Database\Seeders;

use Database\Seeders\items\BaseArmorSeeder;
use Database\Seeders\items\BaseWeaponSeeder;
use Database\Seeders\items\WeaponGroupSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
