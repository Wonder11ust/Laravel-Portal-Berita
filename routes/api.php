<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\API\ApiNewsController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\DashboardArticleController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login & logout
Route::post('/login',[LoginController::class,'authenticate']);
Route::get('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');
Route::get('me',[LoginController::class,'me'])->middleware('auth:sanctum');
Route::post('/register',[RegisterController::class,'store'])->middleware('guest');
Route::get('/users',[RegisterController::class,'index']);

Route::get('/news',[ApiNewsController::class,'index']);


// Category
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/category/{category:id}',[CategoryController::class,'show2']);

// Article
Route::get('/articles',[ArticleController::class,'index']);
Route::get('/article/{article:slug}',[ArticleController::class,'show']);


// Comment
Route::post('/add-comment',[CommentController::class,'store'])->middleware('auth:sanctum');

// Article Dashboard
Route::get('/dashboard/articles',[DashboardArticleController::class,'index'])->middleware(['auth:sanctum','writer']);
Route::post('/dashboard/new-article',[DashboardArticleController::class,'store'])->middleware(['auth:sanctum','writer']);
Route::get('/dashboard/article/edit/{article:slug}',[DashboardArticleController::class,'edit'])->middleware(['auth:sanctum','writer','admin']);
Route::put('/dashboard/article/edit/{article:slug}',[DashboardArticleController::class,'update'])->middleware(['auth:sanctum','writer','admin']);
Route::delete('/dashboard/article/delete/{article:slug}',[DashboardArticleController::class,'destroy'])->middleware(['auth:sanctum','writer']);

//Admin Dashboard
Route::middleware(['auth:sanctum','admin'])->group(function(){
Route::get('/dashboard/admin/articles',[AdminDashboardController::class,'index']);
Route::post('/dashboard/admin/new-article',[AdminDashboardController::class,'store']);
Route::get('/dashboard/admin/article/edit/{article:slug}',[AdminDashboardController::class,'edit']);
Route::put('/dashboard/admin/article/update/{article:slug}',[AdminDashboardController::class,'update']);
Route::delete('/dashboard/admin/article/delete/{article:slug}',[AdminDashboardController::class,'destroy']);

// tambah kategori dan lihat kategori
Route::post('/new-category',[CategoryController::class,'store']);
Route::get('/admin/categories',[CategoryController::class,'index']);
Route::put('/category/edit/{category:id}',[CategoryController::class,'update']);
});