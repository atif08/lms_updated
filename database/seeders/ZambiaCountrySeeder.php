<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZambiaCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            'name'         => 'Zambia',
            'country_code' => 'ZM',
            'flag_url'     => 'https://flagcdn.com/w320/zm.png', // standard CDN flag
            'phone_code'   => '+260',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
