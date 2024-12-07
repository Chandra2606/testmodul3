<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'name' => 'John Doe',
                'email' => 'johndoe@email.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jane Smith', 
                'email' => 'janesmith@email.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Author::factory()->count(10000)->create();
    }
}
