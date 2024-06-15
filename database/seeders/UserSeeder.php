<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole('user');
        }

        User::create([
            'Username' => "administrator",
            'Password' => Hash::make('administrator'),
            'Email' => "admin@admin.com",
            'NamaLengkap' => "Administrator",
            "Alamat" => "-",
        ])->assignRole('admin');
    }
}
