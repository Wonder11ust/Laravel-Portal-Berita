<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
   // protected $with = ['comments','user'];
    public function author()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'article_categories','article_id','category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'article_id');
    }

  
    public function scopeFilter($query,array $filters)
    {
        $query->when($filters['search'] ?? false,function($query,$search){
            return $query->where('title','like','%'.$search.'%')
            ->orWhere('content','like','%'.$search.'%')
            ->orWhere('slug','like','%'.$search.'%');
        });

        $query->when($filters['category']  ?? false,function($query,$category){
            return $query->whereHas('category_name',function($query) use($category){
                $query->where('category_name',$category);
            });
        });
    }
}
