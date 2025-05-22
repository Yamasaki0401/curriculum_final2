<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('mypage', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = Auth::guard('web')->user();
        return view('mypage.edit', compact('user'));
    }

    public function withdraw(Request $request)
    {
        $user = Auth::guard('web')->user();

        // 退会処理（論理削除など）
        $user->delete();

        Auth::guard('web')->logout();

        return redirect('/')->with('status', '退会処理が完了しました。');
    }
}
