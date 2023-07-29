<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $costs = [];

        for ($i = 0; $i < 1000; $i++) {
            $costs[] = ($i + 1) * 50;
        }

        $cost = $costs[array_rand($costs)];

        return [
            'name' => $this->faker->sentence(3),
            // 'cost' => rand(100, 100000),
            'cost' => $cost,
        ];
    }
}
