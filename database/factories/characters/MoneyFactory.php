<?php

namespace Database\Factories\characters;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\characters\Money>
 */
class MoneyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gf' => $this->faker->numberBetween(0, 100),
            'tt' => $this->faker->numberBetween(0, 100),
            'kl' => $this->faker->numberBetween(0, 100),
            'mu' => $this->faker->numberBetween(0, 100)
        ];
    }
}
