<?php

use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'blog'], function (){
    Route::resource('posts', PostController::class)->names('blog.posts');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Blog Admin Panel


Route::group(['prefix'=>'admin/blog'], function (){
    // BlogCategory
   $methods = ['index','edit','store','update','create'];
   Route::resource('categories', CategoryController::class)
       ->only($methods)
       ->names('blog.admin.categories');
});

