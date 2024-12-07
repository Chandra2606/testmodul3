<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::resource('users', UserController::class);
    Route::get('/users/getdata', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    Route::resource('author', AuthorController::class);
    Route::get('/author/show', [AuthorController::class, 'show'])->name('author.show');

    Route::resource('category', CategoryController::class);
    Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');

    Route::resource('tag', TagController::class);
    Route::get('/tag/show', [TagController::class, 'show'])->name('tag.show');
});


require __DIR__.'/auth.php';
