<?php

namespace Database\Factories\characters;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\characters\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),

            'max_hp' => $this->faker->numberBetween(1, 15),
            'current_hp' => fn(array $attributes) => $attributes['max_hp'],
            'max_mana' => null,
            'current_mana' => null,

            'strength_value' => $this->faker->numberBetween(1, 16),
            'strength_bonus' => $this->faker->numberBetween(0, 3),
            'agility_value' => $this->faker->numberBetween(1, 16),
            'agility_bonus' => $this->faker->numberBetween(0, 3),
            'constitution_value' => $this->faker->numberBetween(1, 16),
            'constitution_bonus' => $this->faker->numberBetween(0, 3),
            'intelligence_value' => $this->faker->numberBetween(1, 16),
            'intelligence_bonus' => $this->faker->numberBetween(0, 3),
            'charisma_value' => $this->faker->numberBetween(1, 16),
            'charisma_bonus' => $this->faker->numberBetween(0, 3),

            // $table->foreignIdFor(BaseArmor::class)->nullable()->constrained()->nullOnDelete();
            // $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
        ];
    }
}
