<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\GuideController;
use Illuminate\Support\Facades\Auth;

// homeを/topにする
Route::get('/', function () {
    return redirect('/top');
});

// login
Auth::routes();
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register/confirm', [RegisterController::class, 'confirmRegistration'])->name('register.confirm');
Route::post('register/store', [RegisterController::class, 'storeRegistration'])->name('register.store');

//gest
Route::get('/top', [App\Http\Controllers\HomeController::class, 'index'])->name('top');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/detail', [PostController::class, 'showPost'])->name('posts.detail');
Route::get('/guide', [GuideController::class, 'index'])->name('guide');
//Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
//Route::get('/search', [SearchController::class, 'index'])->name('search');




//管理者ログイン
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function(){
        //管理ページ
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
});

// ユーザー
Route::middleware('auth:user')->group(function () {
    // マイページ
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
        //カテゴリ
        //Route::get('/top', [CategoryController::class, 'index'])->name('top');
        //Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');
        //投稿
    Route::get('/posts/create', [PostController::class, 'createPost'])->name('posts.create');
    Route::post('/posts/confirm', [PostController::class, 'confirmPost'])->name('posts.confirm');
    Route::post('/posts/store', [PostController::class, 'storePost'])->name('posts.store');

        // 依頼
    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');
    Route::post('/requests/confirm', [RequestController::class, 'confirm'])->name('requests.confirm');
    Route::post('/requests/store', [RequestController::class, 'store'])->name('requests.store');
});



