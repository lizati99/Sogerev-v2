<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
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
            'description' => $this->faker->sentence(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'region' => $this->faker->state(),
            'country' => $this->faker->country(),
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber(),
            'contact' => $this->faker->phoneNumber(),
            'website' => $this->faker->url()
        ];
    }
}
