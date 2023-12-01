<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleDetailResource;

use function PHPSTORM_META\map;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $articles = Article::with('categories')->latest()->filter(request(['search']))->get();
        return response()->json([
            'status'=>200,
            'articles'=>$articles
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
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
     * Store a newly created resource in storage.
     */
    public function show(Article $article)
    {
        $detail = Article::with(['author','comments'])->where('slug',$article->slug)->get();
         return response()->json([
             'status' => 200,
             'message'=>'Data Artikel',
             'article' => $detail,      
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
         return response()->json([
             'status' => 200,
             'message'=>'Edit Artikel',
             'article' => $article,      
         ]);
    }


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

    public function users()
    {
        $users =User::where('role_id','3')->get();
        return response()->json([
            'status'=>200,
            'message'=>'Data User',
            'user'=>$users
        ]);
    }

    public function writers()
    {
        $writers = User::where('role_id',2)->get();
        return response()->json([
            'status'=>200,
            'message'=>'Data Writer',
            'writer'=>$writers
        ]);
    }

    public function addWriter(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>['required','max:255','unique:users'],
            'email'=>['required','email','unique:users'],
            'password'=> ['required']
        ]);
        $validatedData['role_id'] = 2;
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);

        return response()->json([
            'status'=>200,
            'message'=>'Data Writer Berhasil Ditambahkan'
        ],200);
    }

    public function editWriter(User $user)
    {
        $writer = User::where('role_id',2)->where('id',$user->id)->get();
        return response()->json([
            'status'=>200,
            'writer'=>$writer
        ]);
    }

    public function updateWriter(User $user, Request $request)
{

        $rules = [
            "email" => "required|email|unique:users,email," . $user->id,
            "password" => "nullable|max:100"
        ];
        if ($request->name != $user->name) {
            $rules['name'] = "required|unique:users";
        }

        $validatedData = $request->validate($rules);

    // Pastikan bahwa user memiliki role_id yang sesuai (2 untuk role writer)
    if ($user->role_id !== 2) {
        return response()->json([
            'status' => 403,
            'message' => 'Forbidden: Access denied for non-writer user.'
        ], 403);
    }

    $user->update($validatedData);

    return response()->json([
        'status' => 200,
        'message'=>'Data Writer Berhasil Diperbarui',
        'writer' => $user
    ]);
}

public function destroyWriter(User $user)
{
    try {
        // Menggunakan transaksi untuk memastikan keberhasilan operasi
        DB::beginTransaction();

        // Hapus pengguna
        $user->delete();

        // Commit transaksi jika semua operasi berhasil
        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'User dan Artikel Berhasil dihapus'
        ]);
    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        DB::rollback();

        return response()->json([
            'status' => 500,
            'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
        ], 500);
    }
}





}
