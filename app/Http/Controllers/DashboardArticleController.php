<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ArticleDetailResource;

class DashboardArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $articles = Article::where('user_id',$user)->get();
        return response()->json([
            'status'=>200,
            'articles'=>$articles
        ],200);
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:articles',
            'slug' => 'required|unique:articles',
            'content' => 'required',
            'category' => 'required|array',
            'image_url'=>'required',
          
        ]);
    

        $validatedData['user_id'] = Auth::user()->id;
        // Buat artikel
        $article = Article::create($validatedData);
    
        // Sync kategori dengan artikel
        $article->categories()->sync($request->category);
    
        return response()->json([
            'status' => 200,
            'message' => 'Artikel Baru Berhasil Ditambahkan',
            'data' => $article
        ], 200);
    }




    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $detail = Article::with(['comments','author'])->where('slug',$article->slug)->get();
         return response()->json([
             'status' => 200,
             'article' => $detail,      
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    

    public function edit(Article $article)
    {
        //$comments = $article->comments;
         return response()->json([
             'status' => 200,
             'article' => $article,      
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $rules = [
            'title' => 'required|max:255',
            'category' => 'required|array',
            'image_url' => 'required',
            'content' => 'required'
        ];

        if ($request->slug != $article->slug) {
            $rules['slug'] = 'required|unique:articles';
        }

        $validatedData = $request->validate($rules);
        $validatedData['user_id'] =Auth::user()->id;
       

       // Article::where('id',$article->id)->update($validatedData);
     $article->update($validatedData);
     $existingCategories = array_unique($article->categories->pluck('id')->toArray());
     $requestCategories = array_unique($request->category);
     $categoriesToAdd = array_diff($requestCategories,$existingCategories);
     $categoriesToRemove = array_diff($existingCategories,$requestCategories);
     $article->categories()->attach($categoriesToAdd);
     $article->categories()->detach($categoriesToRemove);

     //$article->categories()->sync($request->category);

        return response()->json([
            'status'=>200,
            'message'=>'Artikel Berhasil Di Update',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Article::destroy($article->id);
        return response()->json([
            'status'=>200,
            'message'=>'Data Artikel Berhasil dihapus'
        ]);
    }

   
}
