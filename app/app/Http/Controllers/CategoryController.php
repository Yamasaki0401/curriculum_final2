<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function index()
    {
        $categories = Category::all();
        return view('top', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);
        // カテゴリに関連する投稿を取得（Post モデルがカテゴリIDを持っている場合）
        $posts = $category->posts; // 投稿を取得

        return view('category.show', compact('category', 'posts'));
    }
}
