<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use App\Models\Category;
use App\Models\Request as ModelsRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $query = ModelsRequest::query();

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

        $requests = $query->latest()->paginate(9);
        $categories = Category::all();

        return view('requests.index', compact('requests', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('requests.create' , compact('categories'));
    }

    public function confirmRequest(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'tel' => 'nullable|string|max:11',
            'request_detail' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|string|',
            'status' => 'required|in:掲載中,進行中,完了',

        ]);


        // セッションに保存
        Session::put('request_data', $validated);

        $categoryName = Category::find($validated['category_id'])->name;

        return view('requests.confirm', compact('categoryName'));
    }

    public function storeRequest(Request $request)
    {
        $data = session('request_data');

        $data['user_id'] = Auth::guard('web')->id();
        $data['status'] = '掲載中';

        ModelsRequest::create($data);

        session()->forget('request_data');

        return redirect()->route('mypage.index')->with('success', '依頼を投稿しました。');
    }

    public function showRequest(ModelsRequest $request)
    {
        $type = 'request'; // モデルタイプを 'request' に設定
        return view('requests.detail', [
            'requestModel' => $request,
            'type' => $type,  // ここで 'type' をビューに渡す
            'model' => $request,  // $model に $request を渡す
        ]);
    }

    public function editRequest(ModelsRequest $requestModel)
    {
        if ($requestModel->status !== '掲載中') {
            return redirect()->route('mypage.index')->with('error', 'この投稿は編集できません。');
        }
        // 認可チェック
        if ($requestModel->user_id !== auth()->guard('web')->id()) {
            abort(403, 'ログインしなおしてください。');
        }

        $categories = Category::all();
        return view('requests.edit', compact('requestModel', 'categories'));
    }

    public function updateRequest(Request $request, ModelsRequest $requestModel)
    {
        if ($requestModel->user_id !== auth()->guard('web')->id()) {
            abort(403, 'ログインしなおしてください。');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'tel' => 'nullable|string|max:11',
            'request_detail' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|string|',
            'status' => 'required|in:掲載中,進行中,完了',
        ]);



        $requestModel->update($validated);

        return redirect()->route('requests.detail', ['request' => $requestModel->id])
            ->with('success', '投稿を更新しました。');
    }

    public function destroyRequest(ModelsRequest $requestModel)
    {
        if ($requestModel->user_id !== auth()->guard('web')->id()) {
            abort(403, 'Unauthorized');
        }

        $requestModel->delete();

        return redirect()->route('mypage.index')->with('success', '投稿を削除しました。');
    }

}
