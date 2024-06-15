<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'user', 'guard_name' => 'web'],
        ]);
    }
}
