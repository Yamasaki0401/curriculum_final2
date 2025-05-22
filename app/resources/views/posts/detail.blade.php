@extends('layouts.user')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4">投稿内容詳細</h2>

    <div class="card p-4 mx-auto" style="max-width: 800px; position: relative;">
        <!-- 投稿画像 -->
        <img src="{{ asset($post->image ?? 'storage/images/posts_image.png') }}" class="img-fluid mb-3 mx-auto d-block" style="max-height: 300px;">

        <!-- 投稿情報 -->
        <h4>タイトル：{{ $post->title }}</h4>
        <p>金額：{{ $post->amount }}円〜ご相談にのります！！</p>
        <p>内容：{{ $post->introduction, 30 }}</p>
        @if(auth()->check())
        <div class="mt-4 text-center">
            <a href="#" class="btn btn-outline-success">
            依頼する
            </a>
        </div>
@endif
        <!-- メニュー（右上3点） -->
        <div class="position-absolute end-0 top-0 m-3 dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">違反報告する</a></li>
                <li><a class="dropdown-item" href="#">口コミを投稿する</a></li>
                @if(auth()->check() && auth()->id() === $post->user_id)
                    <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">編集する</a></li>
                    <li>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('削除しますか？');">
                            @csrf @method('DELETE')
                            <button class="dropdown-item">削除する</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- 口コミ
    <h4 class="mt-5">口コミ</h4>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        forelse($post->reviews as $review)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{ $review->title }}</h5>
                    <p class="card-text">{ $review->body }}</p>
                </div>
                <div class="card-footer text-muted">
                    <img src="{ $review->user->avatar ?? asset('images/avatar-default.png') }}" class="rounded-circle me-2" width="32">
                    { $review->user->name }}<br>
                    <small>{ $review->created_at->format('Y年n月j日') }}</small>
                </div>
            </div>
        </div>
        empty
        <p class="text-muted">まだ口コミはありません。</p>
        endforelse
    </div> -->

</div>
@endsection
