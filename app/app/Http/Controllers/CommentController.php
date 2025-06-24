<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:post,request',
            'id' => 'required|integer',
            'body' => 'required|string|max:500',
        ]);

        $user = auth()->guard('web')->user();

        if ($request->type === 'post') {
            $model = Post::findOrFail($request->id);
        } else {
            $model = RequestModel::findOrFail($request->id);
        }

        $comment = $model->comments()->create([
            'user_id' => $user->id,
            'body' => $request->body,
        ]);

        $commentHtml = view('components.single-comment', ['comment' => $comment])->render();

        return response()->json([
            'success' => true,
            'commentHtml' => $commentHtml,
        ]);
    }
}
