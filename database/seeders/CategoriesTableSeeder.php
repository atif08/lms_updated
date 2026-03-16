<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology','slug'=>'technology','created_at'=>now()],
            ['name' => 'Business','slug'=>'business','created_at'=>now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
