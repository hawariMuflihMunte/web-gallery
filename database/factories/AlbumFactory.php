<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all();
        $data = [];

        foreach ($user as $key => $value) {
            array_push($data, $value->UserID);
        }

        return [
            "NamaAlbum" => fake()->name(),
            "Deskripsi" => fake()->text(100),
            "TanggalDibuat" => fake()->date(),
            "UserID" => fake()->randomElement($data),
        ];
    }
}
