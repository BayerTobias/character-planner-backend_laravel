<?php

namespace Database\Factories\characters;

use App\Models\characters\CharacterRace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\characters\CharacterRace>
 */
class CharacterRaceFactory extends Factory
{
    protected $model = CharacterRace::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
