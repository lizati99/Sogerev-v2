<?php

namespace Database\Factories;

use App\Models\SubCategory;
use App\Models\User;
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
        return [
            'name' => $this->faker->word,
            'ref' => $this->faker->unique()->numerify('P-####'),
            'description' => $this->faker->sentence(10),
            'pricePurchase' => $this->faker->randomFloat(2, 1, 100),
            'unit_price' => $this->faker->randomFloat(2, 1, 100),
            'unit_price_min' => $this->faker->randomFloat(2, 1, 100),
            'unit_price_max' => $this->faker->randomFloat(2, 1, 100),
            // 'quantity' => $this->faker->randomNumber(2),
            'is_available' => $this->faker->boolean,
            // 'stock_id' => \App\Models\Stock::factory(),
            'createdBy' => User::inRandomOrder()->first()?->id,
            'updatedBy' => User::inRandomOrder()->first()?->id,
            'subCategory_id' => SubCategory::inRandomOrder()->first()?->id,
        ];
    }
}
