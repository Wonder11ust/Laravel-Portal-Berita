<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\News;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\ArticleCategories;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
        User::factory(5)->create();
        Article::factory(10)->create();
        Category::factory(5)->create();
        ArticleCategories::factory(10)->create();
        Comment::factory(10)->create();
    }
}
