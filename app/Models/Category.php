<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name','category_image'];

    public function articles()
    {
        return $this->belongsToMany(Article::class,'article_categories','category_id','article_id');
    }
}
