<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Programming',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Technology',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Framework',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
