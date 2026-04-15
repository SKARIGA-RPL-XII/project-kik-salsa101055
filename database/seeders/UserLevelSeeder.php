<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLevelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_levels')->insert([
            ['id_level' => 1, 'level_name' => 'Beginner', 'min_exp' => 0, 'max_exp' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['id_level' => 2, 'level_name' => 'Bronze', 'min_exp' => 101, 'max_exp' => 300, 'created_at' => now(), 'updated_at' => now()],
            ['id_level' => 3, 'level_name' => 'Silver', 'min_exp' => 301, 'max_exp' => 600, 'created_at' => now(), 'updated_at' => now()],
            ['id_level' => 4, 'level_name' => 'Gold', 'min_exp' => 601, 'max_exp' => 1000, 'created_at' => now(), 'updated_at' => now()],
            ['id_level' => 5, 'level_name' => 'Platinum', 'min_exp' => 1001, 'max_exp' => 9999, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}