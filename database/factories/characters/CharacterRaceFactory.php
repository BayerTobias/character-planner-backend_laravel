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
            "strength_modifier" => $this->faker->numberBetween(-2, +2),
            "agility_modifier" => $this->faker->numberBetween(-2, +2),
            "constitution_modifier" => $this->faker->numberBetween(-2, +2),
            "intelligence_modifier" => $this->faker->numberBetween(-2, +2),
            "charisma_modifier" => $this->faker->numberBetween(-2, +2),
        ];
    }
}
