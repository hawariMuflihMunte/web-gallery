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
            'Username' => fake()->userName(),
            'Password' => Hash::make('12345678'),
            'Email' => fake()->unique()->safeEmail(),
            'NamaLengkap' => fake()->name(),
            "Alamat" => fake()->address(),
        ];
    }
}
