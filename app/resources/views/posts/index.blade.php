@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row col-md-10 px-4">
            <h2 class="text-center mt-5">投稿一覧</h2>

            <div class="row row-cols-5 row-cols-md-3 g-5">
                @foreach($posts as $post)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset($post->image ?? 'storage/images/posts_image.png') }}" class="card-img-top" alt="投稿画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text"><strong>金額¥{{ $post->amount }}</strong></p>
                            <p class="card-text text-muted">{{ Str::limit($post->introduction, 30) }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('posts.detail', $post->id) }}" class="btn btn-outline-primary btn-sm w-100">詳細を見る</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
</div>
@section('content')
