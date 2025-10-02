<?php

namespace Database\Factories\items;

use App\Models\Items\BaseArmor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\items\BaseArmor>
 */
class BaseArmorFactory extends Factory
{
    protected $model = BaseArmor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . 'Armor',
            'min_str' => $this->faker->numberBetween(1, 10),
            'armor_bonus' => $this->faker->numberBetween(0, 6),
            'maneuver_bonus' => $this->faker->numberBetween(-5, 5),
            'weight' => $this->faker->randomFloat(1, 1, 50),
        ];
    }
}
