@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">新規投稿登録</h2>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mx-auto" style="max-width: 600px;">

            <div id="posts_image" class="preview text-center mb-4">
                <div class="text-center mb-4">
                    <img id="preview" src="{{ session('post_data.image') ?? asset('storage/images/posts_image.png') }}" alt="image" style="max-width: 150px;">
                </div>
            </div>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="card p-4 shadow-sm">
                <h4><strong>{{ session('post_data.title') }}</strong> / {{ $categoryName }}</h4>
                <p class="mb-1">金額：{{ session('post_data.amount') }}円～</p>
                <p>{{ session('post_data.introduction') }}</p>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('posts.create') }}" class="btn btn-outline-secondary">編集に戻る</a>
                <button type="submit" class="btn btn-outline-primary">登録する</button>
            </div>
        </div>
    </form>
</div>
@endsection
