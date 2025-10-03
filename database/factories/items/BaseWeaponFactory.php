<?php

namespace Database\Factories\items;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\items\BaseWeapon>
 */
class BaseWeaponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . 'Weapon',
            'min_str' => $this->faker->numberBetween(0, 10),
            'dmg' => $this->faker->numberBetween(-2, 5),
            'attribute' => $this->faker->randomElement(['ST', 'GE', 'ST/GE']),
            'weight' => $this->faker->randomFloat(1, 1, 50),
            'ini_bonus' => $this->faker->numberBetween(-2, 5),
        ];
    }
}
