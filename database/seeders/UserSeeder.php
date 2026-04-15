<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Upvity',
            'email' => 'admin@upvity.com',
            'password' => Hash::make('password'),
            'id_role' => 1,
            'id_level' => 1,
            'exp' => 0,
            'coin' => 0,
        ]);

        // User
        User::create([
            'name' => 'User Upvity',
            'email' => 'user@upvity.com',
            'password' => Hash::make('password'),
            'id_role' => 2,
            'id_level' => 1,
            'exp' => 0,
            'coin' => 0,
        ]);
    }
}