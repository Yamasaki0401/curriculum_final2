@extends('layouts.admin') {{-- 管理者用レイアウト --}}

@section('content')
<div class="container py-4">
    <h2 class="text-center">管理画面</h2>

    {{-- タブナビゲーション --}}
    <ul class="nav nav-tabs mb-3" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab">ユーザー一覧</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab">投稿一覧</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabsContent">

        {{-- ユーザー一覧 --}}
        <div class="tab-pane fade show active" id="users" role="tabpanel">
            @foreach($users as $user)
                <div class="card mb-3 p-3 bg-light-purple d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <div><strong>ユーザーID：</strong>{{ $user->id }}</div>
                        <div><strong>ユーザー名：</strong>{{ $user->name }}</div>
                        @if($user->violation_reports_count)
                            <div class="mt-2 text-danger">
                                🖊️ 違反報告数：{{ $user->violation_reports_count }}件
                            </div>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-dark text-dark" title="詳細">
                            <i class="bi bi-info-square"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger" title="削除">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>

        {{-- 投稿一覧 --}}
        <div class="tab-pane fade" id="posts" role="tabpanel">
            <form class="d-flex mb-3">
                <input class="form-control me-2" type="search" name="search" placeholder="検索" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">検索</button>
            </form>

            @foreach($posts as $post)
                <div class="card mb-3 p-3 bg-light-purple d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <div><strong>投稿ID：</strong>{{ $post->id }}</div>
                        <div><strong>タイトル：</strong>{{ $post->title }}</div>
                        <div><strong>投稿日時：</strong>{{ $post->created_at->format('Y年m月d日 H:i') }}</div>
                    </div>
                    <div>
                        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-outline-dark text-dark" title="詳細">
                            <i class="bi bi-info-square"></i>
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger" title="削除">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>
@endsection

