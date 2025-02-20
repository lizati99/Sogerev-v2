<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'current_stock' => $this->faker->numberBetween(0, 1000),
            'stock_in' => $this->faker->numberBetween(0, 500),
            'stock_out' => $this->faker->numberBetween(0, 300),
            'stock_stolen' => $this->faker->numberBetween(0, 100),
            'stock_damaged' => $this->faker->numberBetween(0, 100),
            'stock_returned' => $this->faker->numberBetween(0, 200),
            'product_id' => Product::inRandomOrder()->first()?->id,
        ];
    }
}
