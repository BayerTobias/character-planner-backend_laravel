<?php

namespace Database\Factories\characters;

use App\Models\characters\CharacterClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\characters\CharacterClass>
 */
class CharacterClassFactory extends Factory
{
    protected $model = CharacterClass::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'base_lvl_hp' => $this->faker->numberBetween(1, 5),
            'base_lvl_mana' => $this->faker->optional()->numberBetween(1, 5),
            'main_stat' => $this->faker->randomElement(['strength', 'agility', 'constitution', 'intelligence', 'charisma',]),
            'color' => $this->faker->word(),
        ];
    }
}
