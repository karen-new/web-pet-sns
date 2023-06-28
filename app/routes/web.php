<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\PetsnsController::class, 'index'])->middleware('auth');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/like/{id}',[App\Http\Controllers\LikeController::class,'store'])->name('likes.like');
Route::delete('/unlike/{id}',[App\Http\Controllers\LikeController::class,'destroy'])->name('likes.unlike');;
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'show'])->name('search.show');
Route::get('/mypage/index/{id}',[App\Http\Controllers\MypageController::class, 'index'])->name('mypage.index');
Route::get('/mypage/edit/{id}',[App\Http\Controllers\MypageController::class, 'edit'])->name('mypage.edit');
Route::post('/mypage/edit/{id}',[App\Http\Controllers\MypageController::class, 'edit'])->name('mypage.edit');
Route::put('/mypage/update/{id}',[App\Http\Controllers\MypageController::class, 'update'])->name('mypage.update');
Route::post('/mypage/follow/{id}',[App\Http\Controllers\MypageController::class, 'follow'])->name('mypage.follow');
Route::get('/mypage/follow/{id}',[App\Http\Controllers\MypageController::class, 'follow'])->name('mypage.follow');
Route::post('/mypage/unfollow/{id}',[App\Http\Controllers\MypageController::class, 'unfollow'])->name('mypage.unfollow');
Route::get('/mypage/unfollow/{id}',[App\Http\Controllers\MypageController::class, 'unfollow'])->name('mypage.unfollow');
Route::resource('pet', 'App\Http\Controllers\PetsnsController');
