<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\CommentController;
use App\Models\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ViolationReported;
use Illuminate\Support\Facades\Notification;


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

Route::get('/guide', [GuideController::class, 'index'])->name('guide');
Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');

//Route::get('/search', [SearchController::class, 'index'])->name('search');




//管理者ログイン
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function(){
        //管理ページ
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/posts/{post}', [AdminPostController::class, 'show'])->name('posts.show');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::delete('posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    });
});

// ユーザー
Route::middleware('auth')->group(function () {
    // マイページ
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
        //カテゴリ
        //Route::get('/top', [CategoryController::class, 'index'])->name('top');
        //Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');

    Route::post('/posts/confirm', [PostController::class, 'confirmPost'])->name('posts.confirm');
    Route::post('/requests/confirm', [RequestController::class, 'confirmRequest'])->name('requests.confirm');

    Route::post('/posts/store', [PostController::class, 'storePost'])->name('posts.store');
    Route::post('/requests/store', [RequestController::class, 'storeRequest'])->name('requests.store');


    Route::post('/posts/{post}/violation', [ViolationController::class, 'reportPost'])->name('posts.violation');
    Route::get('/posts/{post}/edit', [PostController::class, 'editPost'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'updatePost'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroyPost'])->name('posts.destroy');

    Route::get('/requests/{request}/edit', [RequestController::class, 'editRequest'])->name('requests.edit');
    Route::put('/requests/{request}', [RequestController::class, 'updateRequest'])->name('requests.update');
    Route::delete('/requests/{request}', [RequestController::class, 'destroyRequest'])->name('requests.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/test-comment', function (Request $request) {
        return response()->json(['message' => 'コメントが正常に投稿されました']);
    });
});

//gest
Route::get('/posts/{post}', [PostController::class, 'showPost'])->name('posts.detail');
Route::get('/requests/{request}', [RequestController::class, 'showRequest'])->name('requests.detail');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');





