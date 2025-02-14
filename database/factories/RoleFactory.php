<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            // 'permissions' => Role::factory()->has(Permission::factory()->count(rand(1, 5)))->create() // relationship with Permission model
        ];
    }
}
