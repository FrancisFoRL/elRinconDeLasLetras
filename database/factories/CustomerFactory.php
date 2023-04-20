<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    private static $first = false;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
            Primero lo que haremos es crear un usuario, para que a la vez que un usuario se crea, este tenga tambien su
            perfil de customer.
        */
        $user = User::factory()->create(); //Creamos un nuevo usuario

        return [
            'name' => $user->name,
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'address' => $this->faker->unique()->address(),
            'country' => 'España',
            'population' => 'Almería',
            'province' => 'Almería',
            'postal_code' => $this->faker->postcode(),
            'card_info' => $this->faker->unique()->creditCardNumber('Visa', true),
            'user_id' => $user->id
        ];
    }
}
