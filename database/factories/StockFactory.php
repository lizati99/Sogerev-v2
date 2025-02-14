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
            'available_quantity' => $this->faker->randomNumber(2),
            'unit_price' => $this->faker->randomFloat(2, 0, 1000),
            'product_id' => Product::inRandomOrder()->first()?->id,
        ];
    }
}
