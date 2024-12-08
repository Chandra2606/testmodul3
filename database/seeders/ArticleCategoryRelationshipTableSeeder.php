<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use App\Models\ArticleCategoryRelationship;
use Illuminate\Database\Seeder;

class ArticleCategoryRelationshipTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        ArticleCategoryRelationship::insert([
            [
                'article_id' => 1,
                'category_id' => 1,
                
            ],
            [
                'article_id' => 2,
                'category_id' => 1,
                
            ],
            [
                'article_id' => 3,
                'category_id' => 2,
                
            ]
        ]);
    }
}
