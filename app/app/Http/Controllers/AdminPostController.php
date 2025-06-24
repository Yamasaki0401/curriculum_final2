<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function show(Post $post)
    {
        return view('auth.admin.posts', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('auth.admin.dashboard')->with('success', '投稿を削除しました');
    }
}
