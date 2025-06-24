<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use App\Models\Category;
use App\Notifications\ViolationReportNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\ViolationReport;
use App\Notifications\ViolationReported;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
        // 近所フィルター


        if ($request->filled('nearby') && $request->nearby === '1') {
            $myCity = auth()->guard('web')->user()->city;

            $query->whereHas('user', function ($q) use ($myCity) {
                $q->where('city', $myCity);
            });
        }
        // カテゴリフィルター
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->with('user')->latest()->paginate(9);
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function confirmPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|in:0,1',
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
            $oldPath = str_replace('/storage/', '', $data['image']);
            $newPath = str_replace('temp_images/', 'posts', $oldPath);
            Storage::disk('public')->move($oldPath, $newPath);
            $data['image'] = $newPath;
        }

        $data['user_id'] = auth()->guard('web')->id();
        Post::create($data);

        Session::forget('post_data');

        return redirect()->route('mypage.index')->with('投稿が登録されました');
    }

    public function showPost(Post $post)
    {
        $type = 'post';
        return view('posts.detail', [
            'post' => $post,
            'type' => $type,
            'model' => $post,
        ]);
    }

    public function editPost(Post $post)
    {
        // 認可チェック
        if ($post->user_id !== auth()->guard('web')->id()) {
            abort(403, 'ログインしなおしてください。');
        }

        $categories = Category::all();
        return view('posts.edit', compact('post' , 'categories'));
    }

    // 更新処理
    public function updatePost(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->guard('web')->id()) {
            abort(403, 'ログインしなおしてください。');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|in:0,1',
            'introduction' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('post', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.detail', ['post' => $post->id])
            ->with('success', '投稿を更新しました。');
    }

    // 削除処理
    public function destroyPost(Post $post)
    {
        if ($post->user_id !== auth()->guard('web')->id()) {
            abort(403, 'UnPostauthorized');
        }

        $post->delete();

        return redirect()->route('mypage.index')->with('success', '投稿を削除しました。');
    }

    public function reportPost(Request $request, Post $post)
    {
        $user = auth()->guard('web')->user();

        $alreadyReported = ViolationReport::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->exists();

        if ($alreadyReported) {
            return back()->with('error', 'すでに報告済みです。');
        }

        ViolationReport::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // 投稿にフラグ
        $post->violation_flg = true;
        $post->save();

        // Slackへ通知
        Notification::route('slack', config('services.slack.webhook_url'))
            ->notify(new ViolationReported($post));

        return back()->with('success', '違反報告を受け付けました。');
    }
}
