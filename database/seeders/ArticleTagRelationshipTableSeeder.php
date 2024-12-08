<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use App\Models\ArticleTagRelationship;
use Illuminate\Database\Seeder;

class ArticleTagRelationshipTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        ArticleTagRelationship::insert([
            [
                'article_id' => 1,
                'tag_id' => 1,

            ],
            [
                'article_id' => 1,
                'tag_id' => 2,
                
            ],
            [
                'article_id' => 2,
                'tag_id' => 2,
               
            ],
            [
                'article_id' => 3,
                'tag_id' => 3,
                
            ]
        ]);
    }
}
