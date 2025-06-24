<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ViolationReport;
use Illuminate\Support\Facades\Http;

class ViolationController extends Controller
{
    public function reportPost(Request $request, Post $post)
    {
        $user = auth()->guard('web')->user();

        // 既に報告済みなら中断
        $alreadyReported = ViolationReport::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->exists();

        if ($alreadyReported) {
            return back()->with('error', 'この投稿はすでに報告済みです。');
        }

        ViolationReport::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // フラグを立てる（任意）
        $post->violation_flg = true;
        $post->save();

        $webhookUrl = config('services.slack.webhook_url');

        $message = "🚨 *違反報告がありました*\n"
            . "*投稿タイトル:* {$post->title}\n"
            . "*報告者:* {$user->name}\n"
            . "*リンク:* " . route('posts.detail', $post->id);

        Http::post($webhookUrl, [
            'text' => $message
        ]);

        return back()->with('success', '違反報告が送信されました。');
    }
}
