<?php

namespace Database\Seeders\items;

use App\Models\Items\BaseWeapon;
use App\Models\Items\WeaponGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = WeaponGroup::whereIn('name', [
            'Armbrust',
            'Bogen',
            'Lange Klingenwaffe',
            'Kurze Klingenwaffe',
            'Wuchtwaffe',
            'Stichwaffe',
            'Schleuder',
            'Stangenwaffe',
            'Äxte',
            'Wurfwaffe',
            'Waffenlos',
            'Schleuder'
        ])->get()->keyBy('name');

        $crossbow = BaseWeapon::updateOrCreate(
            ['name' => 'Armbrust'],
            [
                'min_str' => 0,
                'dmg' => 1,
                'attribute' => 'GE',
                'weight' => 5,
                'ini_bonus' => 2
            ]
        );

        $crossbow->weaponGroups()->sync([
            $groups['Armbrust']
        ]);

        $bastardSword = BaseWeapon::updateOrCreate(
            ['name' => 'Bastardschwert'],
            [
                'min_str' => 6,
                'dmg' => 1,
                'attribute' => 'ST/GE',
                'weight' => 3,
                'ini_bonus' => 1
            ]
        );

        $bastardSword->weaponGroups()->sync([
            $groups['Lange Klingenwaffe']
        ]);

        $dagger = BaseWeapon::updateOrCreate(
            ['name' => 'Dolch'],
            [
                'min_str' => 0,
                'dmg' => -2,
                'attribute' => 'ST/GE',
                'weight' => 0.5,
                'ini_bonus' => 2
            ]
        );

        $dagger->weaponGroups()->sync([
            $groups['Wurfwaffe'],
            $groups['Kurze Klingenwaffe'],
            $groups['Stichwaffe'],
        ]);

        $oneHandAxe = BaseWeapon::updateOrCreate(
            ['name' => 'Einhand-Axt'],
            [
                'min_str' => 0,
                'dmg' => 0,
                'attribute' => 'ST/GE',
                'weight' => 3,
                'ini_bonus' => 0
            ]
        );

        $oneHandAxe->weaponGroups()->sync([
            $groups['Wurfwaffe'],
            $groups['Äxte'],
        ]);

        $flail = BaseWeapon::updateOrCreate(
            ['name' => 'Flegel'],
            [
                'min_str' => 0,
                'dmg' => 1,
                'attribute' => 'ST',
                'weight' => 4.5,
                'ini_bonus' => 0
            ]
        );

        $flail->weaponGroups()->sync([
            $groups['Wuchtwaffe']
        ]);

        $foil = BaseWeapon::updateOrCreate(
            ['name' => 'Florett'],
            [
                'min_str' => 0,
                'dmg' => 0,
                'attribute' => 'GE',
                'weight' => 2.5,
                'ini_bonus' => 2
            ]
        );

        $foil->weaponGroups()->sync([
            $groups['Stichwaffe']
        ]);

        $halberd = BaseWeapon::updateOrCreate(
            ['name' => 'Hellebarde'],
            [
                'min_str' => 0,
                'dmg' => 1,
                'attribute' => 'ST',
                'weight' => 5,
                'ini_bonus' => -1
            ]
        );

        $halberd->weaponGroups()->sync([
            $groups['Stangenwaffe']
        ]);

        $compositeBow = BaseWeapon::updateOrCreate(
            ['name' => 'Kompositbogen'],
            [
                'min_str' => 7,
                'dmg' => 1,
                'attribute' => 'ST/GE',
                'weight' => 1.5,
                'ini_bonus' => -1
            ]
        );

        $compositeBow->weaponGroups()->sync([
            $groups['Bogen']
        ]);

        $warhammer = BaseWeapon::updateOrCreate(
            ['name' => 'Kriegshammer'],
            [
                'min_str' => 0,
                'dmg' => 1,
                'attribute' => 'ST',
                'weight' => 3.5,
                'ini_bonus' => 0
            ]
        );

        $warhammer->weaponGroups()->sync([
            $groups['Wuchtwaffe']
        ]);

        $shortBow = BaseWeapon::updateOrCreate(
            ['name' => 'Kurzbogen'],
            [
                'min_str' => 0,
                'dmg' => -1,
                'attribute' => 'GE',
                'weight' => 1.5,
                'ini_bonus' => 1
            ]
        );

        $shortBow->weaponGroups()->sync([
            $groups['Bogen']
        ]);

        $shortSword = BaseWeapon::updateOrCreate(
            ['name' => 'Kurzschwert'],
            [
                'min_str' => 0,
                'dmg' => -1,
                'attribute' => 'ST/GE',
                'weight' => 2,
                'ini_bonus' => 1
            ]
        );

        $shortSword->weaponGroups()->sync([
            $groups['Kurze Klingenwaffe']
        ]);

        $longbow = BaseWeapon::updateOrCreate(
            ['name' => 'Langbogen'],
            [
                'min_str' => 6,
                'dmg' => 0,
                'attribute' => 'ST/GE',
                'weight' => 2,
                'ini_bonus' => 0
            ]
        );

        $longbow->weaponGroups()->sync([
            $groups['Bogen']
        ]);

        $longsword = BaseWeapon::updateOrCreate(
            ['name' => 'Langschwert'],
            [
                'min_str' => 5,
                'dmg' => 1,
                'attribute' => 'ST',
                'weight' => 4,
                'ini_bonus' => 0
            ]
        );

        $longsword->weaponGroups()->sync([
            $groups['Lange Klingenwaffe']
        ]);

        $morningStar = BaseWeapon::updateOrCreate(
            ['name' => 'Morgenstern'],
            [
                'min_str' => 0,
                'dmg' => 1,
                'attribute' => 'ST',
                'weight' => 4,
                'ini_bonus' => 0
            ]
        );

        $morningStar->weaponGroups()->sync([
            $groups['Wuchtwaffe']
        ]);

        $rapier = BaseWeapon::updateOrCreate(
            ['name' => 'Rapier'],
            [
                'min_str' => 0,
                'dmg' => 0,
                'attribute' => 'ST/GE',
                'weight' => 1.5,
                'ini_bonus' => 1
            ]
        );

        $rapier->weaponGroups()->sync([
            $groups['Stichwaffe']
        ]);

        $slingshot = BaseWeapon::updateOrCreate(
            ['name' => 'Schleuder'],
            [
                'min_str' => 0,
                'dmg' => -1,
                'attribute' => 'GE',
                'weight' => 0,
                'ini_bonus' => 1
            ]
        );

        $slingshot->weaponGroups()->sync([
            $groups['Schleuder']
        ]);

        $spear = BaseWeapon::updateOrCreate(
            ['name' => 'Speer'],
            [
                'min_str' => 0,
                'dmg' => -1,
                'attribute' => 'ST/GE',
                'weight' => 4,
                'ini_bonus' => 0
            ]
        );

        $spear->weaponGroups()->sync([
            $groups['Stangenwaffe'],
            $groups['Wurfwaffe']
        ]);

        $staff = BaseWeapon::updateOrCreate(
            ['name' => 'Stab'],
            [
                'min_str' => 0,
                'dmg' => -1,
                'attribute' => 'ST/GE',
                'weight' => 3,
                'ini_bonus' => 1
            ]
        );

        $staff->weaponGroups()->sync([
            $groups['Stangenwaffe']
        ]);

        $weaponless = BaseWeapon::updateOrCreate(
            ['name' => 'Waffenlos'],
            [
                'min_str' => 0,
                'dmg' => -2,
                'attribute' => 'ST/GE',
                'weight' => 0,
                'ini_bonus' => 1
            ]
        );

        $weaponless->weaponGroups()->sync([
            $groups['Waffenlos']
        ]);

        $twoHandedAxe = BaseWeapon::updateOrCreate(
            ['name' => 'Zweihand-Axt'],
            [
                'min_str' => 6,
                'dmg' => 2,
                'attribute' => 'ST',
                'weight' => 6,
                'ini_bonus' => -1
            ]
        );

        $twoHandedAxe->weaponGroups()->sync([
            $groups['Äxte']
        ]);

        $twoHandedSword = BaseWeapon::updateOrCreate(
            ['name' => 'Zweihänder'],
            [
                'min_str' => 6,
                'dmg' => 2,
                'attribute' => 'ST',
                'weight' => 4,
                'ini_bonus' => 0
            ]
        );

        $twoHandedSword->weaponGroups()->sync([
            $groups['Lange Klingenwaffe']
        ]);
    }
}
