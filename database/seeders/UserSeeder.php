<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->delete();

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole('user');
        }
        
        // Create User only if it doesn't already exist
        if (!User::where('Email', 'user@user.net')->exists()) {
            User::create([
                'Username' => 'sser',
                'Password' => Hash::make('12345678'),
                'Email' => 'user@user.net',
                'NamaLengkap' => 'User',
                'Alamat' => '-',
            ])->assignRole('user');
        }

        // Create administrator only if it doesn't already exist
        if (!User::where('Email', 'admin@admin.com')->exists()) {
            User::create([
                'Username' => 'administrator',
                'Password' => Hash::make('administrator'),
                'Email' => 'admin@admin.com',
                'NamaLengkap' => 'Administrator',
                'Alamat' => '-',
            ])->assignRole('admin');
        }
    }
}
