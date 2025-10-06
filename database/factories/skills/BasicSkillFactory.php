<?php

namespace Database\Factories\skills;

use App\Models\skills\BasicSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\skills\BasicSkill>
 */
class BasicSkillFactory extends Factory
{


    protected $model = BasicSkill::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'first_level_cost' => $this->faker->numberBetween(1, 3),
            'second_level_cost' => $this->faker->optional()->numberBetween(2, 6),
            'character_class_id' => null,
        ];
    }
}
