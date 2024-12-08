<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        Tag::insert([
            [
                'name' => 'Laravel',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'PHP', 
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Codeigniter',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
