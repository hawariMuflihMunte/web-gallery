<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            ModelHasRolesSeeder::class,
            UserSeeder::class,
            AlbumSeeder::class,
            FotoSeeder::class,
            // PostSeeder::class,
        ]);
    }
}
