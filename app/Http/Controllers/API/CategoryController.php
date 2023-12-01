<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        //$categories = Category::with('articles.user')->get();
       $categories = Category::all();
        return response()->json([
            'status'=>200,
            'message'=>"Data Kategori",
            'categories'=>$categories
        ]);
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'category_name'=>'required|unique:categories',
            'category_image'=>'required'
        ]);

            Category::create($validatedData);
             return response()->json([
                'status'=>200,
                'message'=>'Category Baru Berhasil ditambahkan',
        ],200);
        
    }

    public function show(Category $category)
    {
        $articles = $category->articles;
        $categoryWithArticles = $category->load('articles');

        return response()->json([
            'status'=>200,
            'category'=>$categoryWithArticles,
        ]);
    }


    public function update(Category $category, Request $request)
    {
        // Menangani kategori yang tidak ditemukan
        if (!$category) {
            return response()->json([
                'message' => 'Category not found.',
            ], 404);
        }
    
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $category->id,
            'category_image'=>'nullable'
        ]);
    
        try {
            $category->update($validatedData);
    
            return response()->json([
                'status' => 200,
                'message' => 'Category Berhasil Diperbarui',
            ], 200);
        } catch (QueryException $e) {
            // Memberikan pesan kesalahan yang lebih spesifik
            return response()->json([
                'message' => 'Failed to update category. ' . $e->getMessage(),
            ]);
        }
    }
}
