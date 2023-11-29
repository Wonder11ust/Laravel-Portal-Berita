<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleDetailResource;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $articles = Article::all();
        $art = ArticleResource::collection($articles);
        return response()->json([
            'status'=>200,
            'articles'=>$art
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:articles',
            'slug' => 'nullable|unique:articles',
            'content' => 'required',
            'category' => 'required|array',
            'image_url'=>'required',
          
        ]);
    

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['slug'] = $this->slug($validatedData['title']);

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
     * Store a newly created resource in storage.
     */
    public function show(Article $article)
    {
        $art =  new ArticleDetailResource($article);
        //$comments = $article->comments;
         return response()->json([
             'status' => 200,
             'article' => $art,      
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $art =  new ArticleDetailResource($article);
        //$comments = $article->comments;
         return response()->json([
             'status' => 200,
             'article' => $art,      
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
//     public function update(Request $request, Article $article)
//     {

//         $rules = [
//             'title' => 'required|max:255',
//             'category' => 'required|array',
//             'image_url' => 'required',
//             'content' => 'required'
//         ];

//         if ($request->slug != $article->slug) {
//             $rules['slug'] = 'required|unique:articles';
//         }

//         $validatedData['user_id'] =Auth::user()->id;
//         $validatedData = $request->validate($rules);
       

//        // Article::where('id',$article->id)->update($validatedData);
//      $article->update($validatedData);
//      $existingCategories = $article->categories()->pluck('id')->toArray();
//      $categoriesToAdd = array_diff($request->category,$existingCategories);
//      $categoriesToRemove = array_diff($existingCategories,$request->category);
//      $article->categories()->attach($categoriesToAdd);
//      $article->categories()->detach($categoriesToRemove);

//    //  $article->categories()->sync($request->category);

//         return response()->json([
//             'status'=>200,
//             'message'=>'Artikel Berhasil Di Update',
//         ],200);
//     }

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
    $validatedData['user_id'] = Auth::user()->id;

    // Perbarui artikel
    $article->update($validatedData);

    // Dapatkan kategori yang sudah ada
    $existingCategories = array_unique($article->categories->pluck('id')->toArray()); //contoh [3,4,5]->sudah unik tidak ada duplikat

    // Periksa dan pastikan request->category tidak mengandung duplikat
    $requestCategories = array_unique($request->category); //[1,2,3]

    // Hitung kategori yang baru harus ditambahkan
    $categoriesToAdd = array_diff($requestCategories, $existingCategories); //[1,2]

    // Hitung kategori yang perlu dihapus
    $categoriesToRemove = array_diff($existingCategories, $requestCategories); //[4,5]

    // Tambahkan kategori baru
    $article->categories()->attach($categoriesToAdd); //tambah kategori[1,2] 

    // Hapus kategori yang tidak lagi diperlukan
    $article->categories()->detach($categoriesToRemove); //hapus kategori[4,5]

    return response()->json([
        'status' => 200,
        'message' => 'Artikel Berhasil Di Update',
    ], 200);
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

    public function slug($title)
    {
        // Menghapus karakter khusus
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $title);
    
        // Mengonversi ke huruf kecil
        $slug = strtolower($slug);
    
        // Menghapus strip di awal dan akhir
        $slug = trim($slug, '-');
    
        return $slug;
    }
}
