<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entreprise>
 */
class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'RS' => $this->faker->name,
            'description'=> $this->faker->sentence(),
            'phone_number_1' => $this->faker->phoneNumber,
            'phone_number_2' => $this->faker->phoneNumber,
            'fix' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'siteweb' => $this->faker->url(),
            // 'logo' => $this->faker->imageUrl(200, 200),
        ];
    }
}
