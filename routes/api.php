<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\DashboardArticleController;
use App\Http\Controllers\API\SavedArticleController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Login & logout
Route::post('/login',[LoginController::class,'authenticate']);
Route::get('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');
Route::get('me',[LoginController::class,'me'])->middleware('auth:sanctum');
Route::post('/register',[RegisterController::class,'store'])->middleware('guest');
Route::get('/users',[RegisterController::class,'index']);




// Category
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/category/{category:id}',[CategoryController::class,'show']);

// Article
Route::get('/articles',[ArticleController::class,'index']);
Route::get('/article/{article:slug}',[ArticleController::class,'show']);
Route::get('/views',[ArticleController::class,'highestViews']);


// Comment
Route::post('/add-comment',[CommentController::class,'store'])->middleware('auth:sanctum');

// Writer Article Dashboard
Route::get('/dashboard/articles',[DashboardArticleController::class,'index'])->middleware(['auth:sanctum','writer']);
Route::post('/dashboard/new-article',[DashboardArticleController::class,'store'])->middleware(['auth:sanctum','writer']);
Route::get('/dashboard/article/{article:slug}',[DashboardArticleController::class,'show'])->middleware(['auth:sanctum','writer']);
Route::get('/dashboard/article/edit/{article:slug}',[DashboardArticleController::class,'edit'])->middleware(['auth:sanctum','writer']);
Route::put('/dashboard/article/update/{article:slug}',[DashboardArticleController::class,'update'])->middleware(['auth:sanctum','writer']);
Route::delete('/dashboard/article/delete/{article:slug}',[DashboardArticleController::class,'destroy'])->middleware(['auth:sanctum','writer']);

//Admin Dashboard
Route::middleware(['auth:sanctum','admin'])->group(function(){
Route::get('/dashboard/admin/articles',[AdminDashboardController::class,'index']);
Route::post('/dashboard/admin/new-article',[AdminDashboardController::class,'store']);
Route::get('/dashboard/admin/article/{article:slug}',[AdminDashboardController::class,'show']);
Route::get('/dashboard/admin/article/edit/{article:slug}',[AdminDashboardController::class,'edit']);
Route::put('/dashboard/admin/article/update/{article:slug}',[AdminDashboardController::class,'update']);
Route::delete('/dashboard/admin/article/delete/{article:slug}',[AdminDashboardController::class,'destroy']);

// tambah kategori dan lihat kategori
Route::post('/new-category',[CategoryController::class,'store']);
Route::get('/admin/categories',[CategoryController::class,'index']);
Route::put('/category/edit/{category:id}',[CategoryController::class,'update']);

// Tambah  Writer dan Lihat Users
Route::get('/dashboard/admin/users',[AdminDashboardController::class,'users']);
Route::get('/dashboard/admin/writers',[AdminDashboardController::class,'writers']);
Route::get('/dashboard/admin/edit-writer/{user:id}',[AdminDashboardController::class,'editWriter']);
Route::post('/dashboard/admin/add-writer',[AdminDashboardController::class,'addWriter']);
Route::put('/dashboard/admin/update-writer/{user:id}',[AdminDashboardController::class,'updateWriter']);
Route::delete('/dashboard/admin/delete-writer/{user:id}',[AdminDashboardController::class,'destroyWriter']);
});

//User Detail
Route::get('/account',[UserController::class,'index'])->middleware('auth:sanctum');
Route::get('/account/{user:id}',[UserController::class,'show'])->middleware('auth:sanctum');
Route::get('/account/edit/{user:id}',[UserController::class,'edit'])->middleware('auth:sanctum');
Route::put('/account/update/{user:id}',[UserController::class,'update'])->middleware('auth:sanctum');
Route::delete('/account/delete/{user:id}',[UserController::class,'delete'])->middleware('auth:sanctum');
Route::put('/account/update-pass/{user:id}',[UserController::class,'updatePassword'])->middleware('auth:sanctum');

//Save Article
Route::post('/article/save/{article:slug}',[SavedArticleController::class,'save'])->middleware('auth:sanctum');
Route::post('/article/unsave/{article:slug}',[SavedArticleController::class,'unsave'])->middleware('auth:sanctum');
Route::get('/saved',[SavedArticleController::class,'index'])->middleware('auth:sanctum');