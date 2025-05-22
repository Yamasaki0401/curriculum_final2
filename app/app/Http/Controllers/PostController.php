<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        // カテゴリフィルター
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->latest()->paginate(9);
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function createPost()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function confirmPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'introduction' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // 一時的に画像を保存（確認画面用）
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('temp_images', 'public');
            $validated['image'] = Storage::url($path);
        }

        // セッションに保存
        Session::put('post_data', $validated);

        $categoryName = Category::find($validated['category_id'])->name;

        return view('posts.confirm', compact('categoryName'));
    }

    public function storePost(Request $request)
    {
        $data = Session::get('post_data');

        if (!$data) {
            return redirect()->route('posts.create')->with('error', '投稿情報が見つかりません。');
        }

        // 本保存のために画像を移動（任意）
        if (!empty($data['image']) && str_contains($data['image'], 'temp_images/')) {
            $oldPath = str_replace('/storage/images/', '', $data['image']);
            $newPath = str_replace('temp_images/', 'posts/', $oldPath);
            Storage::disk('public')->move($oldPath, $newPath);
            $data['image'] = '/storage/images/' . $newPath;
        }

        $data['user_id'] = auth()->id();
        Post::create($data);

        Session::forget('post_data');

        return redirect()->route('mypage.index')->with('投稿が登録されました');
    }

    public function showPost(Post $post)
    {
        return view('posts.detail', compact('post'));
    }

}
