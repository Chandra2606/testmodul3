<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Rafi Chandra',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Test User',
                'email' => 'test@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 