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

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->middleware('auth');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/like/{id}',[App\Http\Controllers\LikeController::class,'store'])->name('likes.like');
Route::delete('/unlike/{id}',[App\Http\Controllers\LikeController::class,'destroy'])->name('likes.unlike');;
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'show'])->name('search.show');
Route::get('/profile/index/{id}',[App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit/{id}',[App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/edit/{id}',[App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}',[App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/follow/{id}',[App\Http\Controllers\ProfileController::class, 'follow'])->name('profile.follow');
Route::get('/profile/follow/{id}',[App\Http\Controllers\ProfileController::class, 'follow'])->name('profile.follow');
Route::post('/profile/unfollow/{id}',[App\Http\Controllers\ProfileController::class, 'unfollow'])->name('profile.unfollow');
Route::get('/profile/unfollow/{id}',[App\Http\Controllers\ProfileController::class, 'unfollow'])->name('profile.unfollow');
Route::resource('post', 'App\Http\Controllers\PostController');
