<?php

namespace Database\Seeders\items;

use App\Models\Items\WeaponGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeaponGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WeaponGroup::firstOrCreate(['name' => 'Armbrust']);
        WeaponGroup::firstOrCreate(['name' => 'Bogen']);
        WeaponGroup::firstOrCreate(['name' => 'Lange Klingenwaffe']);
        WeaponGroup::firstOrCreate(['name' => 'Kurze Klingenwaffe']);
        WeaponGroup::firstOrCreate(['name' => 'Wuchtwaffe']);
        WeaponGroup::firstOrCreate(['name' => 'Stichwaffe']);
        WeaponGroup::firstOrCreate(['name' => 'Schleuder']);
        WeaponGroup::firstOrCreate(['name' => 'Stangenwaffe']);
        WeaponGroup::firstOrCreate(['name' => 'Äxte']);
        WeaponGroup::firstOrCreate(['name' => 'Wurfwaffe']);
        WeaponGroup::firstOrCreate(['name' => 'Waffenlos']);
        WeaponGroup::firstOrCreate(['name' => 'Schleuder']);
    }
}
