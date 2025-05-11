<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register/confirm', [RegisterController::class, 'confirmRegistration'])->name('register.confirm');
Route::post('register/store', [RegisterController::class, 'storeRegistration'])->name('register.store');


//管理者ログイン
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
});

Route::get('/top', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//カテゴリ
Route::get('/top', [CategoryController::class, 'index'])->name('top');
Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');
//投稿
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/confirm', [PostController::class, 'confirm'])->name('posts.confirm');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
