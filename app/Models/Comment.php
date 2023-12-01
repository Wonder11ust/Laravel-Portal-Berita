<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['commentator'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function commentator()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
