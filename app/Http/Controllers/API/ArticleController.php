<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ArticleCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleDetailResource;

class ArticleController extends Controller
{
 
    public function index()
    {
        $articles = Article::with('categories')->latest()->filter(request(['search']))->get();
        return response()->json([
            'status'=>200,
            'message'=>'Data Artikel',
            'articles'=>$articles
        ]);
    }

    

    public function show(Article $article)
{
    $article->increment('views');
    $detail = Article::with(['comments','author','categories'])->where('slug',$article->slug)->get();
    return response()->json([
        'status' => 200,
        'article' => $detail,      
    ]);
}

    public function highestViews()
    {
        $articles = Article::where('views', '>', 0)
        ->orderByDesc('views') // Urutkan berdasarkan jumlah tampilan secara descending
        ->limit(3)
        ->get();

    //  $articles =   Cache::remember('articles',3,function(){
    //         return Article::where('views', '>', 0)
    //         ->orderByDesc('views') // Urutkan berdasarkan jumlah tampilan secara descending
    //         ->limit(3)
    //         ->get();
    //     });

        return response()->json([
            'status'=>200,
            'message'=>'Artikel Dengan Views Paling Banyak',
            'views'=>$articles
        ]);
    }


}
