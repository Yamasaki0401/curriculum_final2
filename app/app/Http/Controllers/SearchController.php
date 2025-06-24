<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Request as RequestModel;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
    public function index(Request $request)
    {

        $categoryId = $request->input('category'); // ←これが必要
        $nearby = $request->input('nearby');
        $type = $request->input('type');
        $filterType = $request->input('type'); // 'post', 'request', または null（全件）
        $keyword = $request->input('keyword');
        $city = Auth::check() ? Auth::user()->city : null;

        $posts = collect();
        $requests = collect();

        // 絞り込み条件がなければ全件表示
        $showAll = empty($keyword) && empty($categoryId) && empty($nearby) && empty($type);

        if ($showAll || empty($type) || $type === 'post') {
            $posts = Post::query()
                ->when($keyword, function ($q) use ($keyword) {
                    $q->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', "%{$keyword}%")
                            ->orWhere('introduction', 'like', "%{$keyword}%");
                    });
                })
                ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
                ->when($nearby && $city, fn($q) => $q->whereHas('user', fn($q2) => $q2->where('city', $city)))
                ->latest()
                ->get();
        }

        if ($showAll || empty($type) || $type === 'request') {
            $requests = RequestModel::query()
                ->when($keyword, function ($q) use ($keyword) {
                    $q->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', "%{$keyword}%")
                            ->orWhere('request_detail', 'like', "%{$keyword}%"); // ←修正ここ！
                    });
                })
                ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
                ->when($nearby && $city, fn($q) => $q->whereHas('user', fn($q2) => $q2->where('city', $city)))
                ->latest()
                ->get();
        }


        $categories = Category::all();

        return view('search.index', compact('posts', 'requests', 'categories'));
    }
}
