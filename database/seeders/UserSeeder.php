<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole('user');
        }

        // Create User only if it doesn't already exist
        if (!User::where('Email', 'user@user.net')->exists()) {
            User::create([
                'id' => Str::uuid(),
                'username' => 'user',
                'password' => Hash::make('user@user'),
                'email' => 'user@user.net',
                'gender' => 'male',
                'full_name' => 'User',
                'address' => '-',
                'slug' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ])->assignRole('user');
        }

        // Create administrator only if it doesn't already exist
        if (!User::where('Email', 'admin@admin.com')->exists()) {
            User::create([
                'id' => Str::uuid(),
                'username' => 'administrator',
                'password' => Hash::make('admin@admin'),
                'email' => 'admin@admin.com',
                'gender' => 'male',
                'full_name' => 'Administrator',
                'address' => '-',
                'slug' => 'administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ])->assignRole('admin');
        }
    }
}
