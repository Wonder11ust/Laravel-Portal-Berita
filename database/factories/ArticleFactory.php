<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(mt_rand(2,8)),
            'slug'=>$this->faker->slug(),
            'image_url'=>$this->faker->imageUrl(200,120,'web-design',true),
            'content'=>collect($this->faker->paragraph(mt_rand(5,10)))->map(fn($p)=>"<p>$p</p>")->implode(""),
            'user_id'=>mt_rand(8,9)
        ];
    }
}
