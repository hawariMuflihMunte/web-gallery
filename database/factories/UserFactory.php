<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'username' => fake()->userName(),
            'password' => Hash::make('12345678'),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['male', 'female', '-']),
            'full_name' => fake()->name(),
            "address" => fake()->address(),
        ];
    }
}
