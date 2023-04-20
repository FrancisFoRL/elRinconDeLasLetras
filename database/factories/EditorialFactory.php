<?php

namespace Database\Factories;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Editorial>
 */
class EditorialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->text(),
            'website' => $this->faker->unique()->url(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'address' => $this->faker->unique()->address(),
        ];
    }
}
