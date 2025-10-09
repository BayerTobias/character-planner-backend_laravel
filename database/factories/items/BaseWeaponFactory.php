<?php

namespace Database\Factories\items;

use App\Models\Items\BaseWeapon;
use App\Models\Items\WeaponGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\items\BaseWeapon>
 */
class BaseWeaponFactory extends Factory
{
    protected $model = BaseWeapon::class;

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

    public function withWeaponGroups(int $count = 1)
    {
        return $this->afterCreating(function ($baseWeapon) use ($count) {
            $groups = WeaponGroup::factory()
                ->count($count)
                ->create();

            $baseWeapon->weaponGroups()->attach($groups->pluck('id'));
        });
    }
}
