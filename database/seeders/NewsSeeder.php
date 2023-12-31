<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            'title'=>fake()->title(),
            'description'=>fake()->paragraph(2,true),
            'category'=>fake()->sentence(),
            'author'=>fake()->email(),
        ]);
    }
}
