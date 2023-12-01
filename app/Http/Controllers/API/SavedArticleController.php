<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Models\SavedArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SavedArticleController extends Controller
{
    public function index()
    {
        
        $savedArticles = SavedArticle::all();
    
        return response()->json([
            'status' => 200,
            'saved_articles' => $savedArticles,
        ]);
    }

    public function save(Article $article)
    {
        // Simpan data ke dalam tabel saved_articles
        $savedArticle = SavedArticle::create([
            'article_id'=>$article->id,
            'user_id'=>Auth::user()->id
        ]);
    
        return response()->json([
            'status' => 200,
            'message' => 'Artikel berhasil disimpan',
            'saved_article' => $savedArticle,
        ]);
    }
}
