<!-- resources/views/mypage/index.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container py-4">
    <!-- ユーザー情報カード -->
    <div class="card mb-4 mx-auto" style="max-width: 400px;">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ Auth::user()->avatar ?? asset('images/avatar-default.png') }}" class="rounded-circle me-3" width="50" height="50" alt="avatar">
                <div>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    <small>{{ Auth::user()->email }}</small>
                </div>
            </div>
            <div>
                <a href="#" class="btn btn-outline-secondary btn-sm me-1">編集</a>  <!--" { route('profile.edit') }}" -->
                <form action="#" method="POST" class="d-inline">  <!--" { route('user.withdraw') }}" -->
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">退会</button>
                </form>
            </div>
        </div>
    </div>

    <!-- タブ切り替え -->
    <ul class="nav nav-tabs mb-3 justify-content-center" id="mypageTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab">投稿</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests" type="button" role="tab">依頼</button>
        </li>
    </ul>

    <div class="text-end mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">新規投稿</a>
    </div>

    <!-- タブ内容 -->
    <div class="tab-content" id="mypageTabContent">
        <!-- 投稿タブ -->
        <div class="tab-pane fade show active" id="posts" role="tabpanel">
            @if($posts->isEmpty())
                <p>投稿はまだありません。</p>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    @foreach ($posts as $post)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $post->image_url ?? asset('storage/images/user_default.jpg') }}" class="card-img-top" alt="投稿画像">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->price ? '$' . number_format($post->price) : '$0' }}<br>{{ Str::limit($post->body, 50) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- 依頼タブ
        <div class="tab-pane fade" id="requests" role="tabpanel">
            if($requests->isEmpty())
                <p>依頼はまだありません。</p>
            else
                <ul class="list-group">
                    foreach ($requests as $request)
                        <li class="list-group-item">
                            <strong>{ $request->post->title }}</strong><br>
                            { Str::limit($request->body, 100) }}
                        </li>
                    endforeach
                </ul>
            endif
        </div> -->
    </div>
</div>
@endsection
