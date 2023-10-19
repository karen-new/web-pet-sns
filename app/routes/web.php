<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your appProfileControllerlication. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->middleware('auth');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/like/{id}',[LikeController::class,'store'])->name('likes.like');
Route::delete('/unlike/{id}',[LikeController::class,'destroy'])->name('likes.unlike');;
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/search', [SearchController::class, 'index'])->name('search');
Route::post('/search', [SearchController::class, 'show'])->name('search.show');
Route::get('/profile/index/{id}',[ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit/{id}',[ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}',[ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/personal',[ProfileController::class, 'personalEdit'])->name('profile.personal');
Route::put('/profile/passwordUpdate',[ProfileController::class, 'passwordUpdate'])->name('profile.passwordUpdate');
Route::put('/profile/emailUpdate',[ProfileController::class, 'emailUpdate'])->name('profile.emailUpdate');
Route::delete('/profile/personal',[ProfileController::class,'destroy'])->name('profile.delete');;
Route::match(['get', 'post'], '/profile/follow/{id}',[ProfileController::class, 'follow'])->name('profile.follow');
Route::match(['get', 'post'], '/profile/unfollow/{id}',[ProfileController::class, 'unfollow'])->name('profile.unfollow');
Route::resource('post', PostController::class);
