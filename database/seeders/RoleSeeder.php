<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id_role' => 1, 'role_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['id_role' => 2, 'role_name' => 'user', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}