<?php

namespace Database\Seeders\skills;

use App\Models\characters\CharacterClass;
use App\Models\skills\BasicSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RangerSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranger = CharacterClass::where('name', 'ranger')->first();

        BasicSkill::updateOrCreate(
            ['name' => 'Athletik'],
            [
                'description' => 'Körperliche Fähigkeiten wie Laufen, Springen und Kraft einsetzen. Wichtig für körperliche Herausforderungen.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Einflussnahme'],
            [
                'description' => 'Überzeugen, Verhandeln und Menschen beeinflussen. Nutzt Charisma und rhetorische Fähigkeiten.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Gezielte Sprüche'],
            [
                'description' => 'Spezifisches Wissen über magische Formeln und Zauber. Beherrschung ausgewählter Zaubersprüche.',
                'first_level_cost' => 4,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Kunst'],
            [
                'description' => 'Fähigkeiten wie Malen, Musizieren oder Schauspielern. Ausdruck und handwerkliches Können.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'List'],
            [
                'description' => 'Cleverness und Täuschung, um Situationen zu manipulieren oder zu überlisten.',
                'first_level_cost' => 3,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Magie entwickeln'],
            [
                'description' => 'Fähigkeit, die eigenen Manapunkte zu erhöhen und magische Energie besser zu kontrollieren.',
                'first_level_cost' => 3,
                'second_level_cost' => 6,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Natur'],
            [
                'description' => 'Wissen über Pflanzen, Tiere und natürliche Zusammenhänge. Überleben in freier Wildbahn.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Reiten'],
            [
                'description' => 'Geschick im Umgang und der Kontrolle von Reittieren. Wichtig für schnelle Fortbewegung.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Schwimmen'],
            [
                'description' => 'Fähigkeit, sich sicher und schnell im Wasser zu bewegen.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Spruchlisten'],
            [
                'description' => 'Kenntnisse über verschiedene Zauberspruchsammlungen und deren Anwendung.',
                'first_level_cost' => 3,
                'second_level_cost' => 6,
                'character_class_id' => $ranger->id
            ]
        );


        BasicSkill::updateOrCreate(
            ['name' => 'Waffen'],
            [
                'description' => 'Umgang mit verschiedenen Waffenarten, von Nahkampf bis Fernkampf.',
                'first_level_cost' => 2,
                'second_level_cost' => 3,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Wahrnehmung'],
            [
                'description' => 'Aufmerksamkeit und Beobachtungsgabe, um Details und Gefahren früh zu erkennen.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );

        BasicSkill::updateOrCreate(
            ['name' => 'Wissen'],
            [
                'description' => 'Allgemeines und spezielles Fachwissen in verschiedenen Bereichen.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
                'character_class_id' => $ranger->id
            ]
        );
    }
}
