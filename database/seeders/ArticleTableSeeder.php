<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::insert([
            [
                'title' => 'Laravel for Beginners',
                'content' => 'A beginner\'s guide to Laravel',
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'PHP for Advanced Users', 
                'content' => 'Advanced PHP programming',
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Introduction to MVC',
                'content' => 'Basic MVC concepts in PHP',
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
