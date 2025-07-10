<?php

namespace Database\Seeders\skills;

use App\Models\characters\CharacterClass;
use App\Models\skills\BasicSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriestSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priest = CharacterClass::where('name', 'priest')->first();

        BasicSkill::updateOrCreate(
            [
                'name' => 'Athletik',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Körperliche Fähigkeiten wie Laufen, Springen und Kraft einsetzen. Wichtig für körperliche Herausforderungen.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Einflussnahme',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Überzeugen, Verhandeln und Menschen beeinflussen. Nutzt Charisma und rhetorische Fähigkeiten.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Gezielte Sprüche',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Spezifisches Wissen über magische Formeln und Zauber. Beherrschung ausgewählter Zaubersprüche.',
                'first_level_cost' => 3,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Kunst',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Fähigkeiten wie Malen, Musizieren oder Schauspielern. Ausdruck und handwerkliches Können.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'List',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Cleverness und Täuschung, um Situationen zu manipulieren oder zu überlisten.',
                'first_level_cost' => 4,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Magie entwickeln',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Fähigkeit, die eigenen Manapunkte zu erhöhen und magische Energie besser zu kontrollieren.',
                'first_level_cost' => 2,
                'second_level_cost' => 3,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Natur',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Wissen über Pflanzen, Tiere und natürliche Zusammenhänge. Überleben in freier Wildbahn.',
                'first_level_cost' => 3,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Reiten',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Geschick im Umgang und der Kontrolle von Reittieren. Wichtig für schnelle Fortbewegung.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Schwimmen',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Fähigkeit, sich sicher und schnell im Wasser zu bewegen.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Spruchlisten',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Kenntnisse über verschiedene Zauberspruchsammlungen und deren Anwendung.',
                'first_level_cost' => 2,
                'second_level_cost' => 4,
            ]
        );


        BasicSkill::updateOrCreate(
            [
                'name' => 'Waffen',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Umgang mit verschiedenen Waffenarten, von Nahkampf bis Fernkampf.',
                'first_level_cost' => 2,
                'second_level_cost' => 4,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Wahrnehmung',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Aufmerksamkeit und Beobachtungsgabe, um Details und Gefahren früh zu erkennen.',
                'first_level_cost' => 2,
                'second_level_cost' => null,
            ]
        );

        BasicSkill::updateOrCreate(
            [
                'name' => 'Wissen',
                'character_class_id' => $priest->id
            ],
            [
                'description' => 'Allgemeines und spezielles Fachwissen in verschiedenen Bereichen.',
                'first_level_cost' => 1,
                'second_level_cost' => null,
            ]
        );
    }
}
