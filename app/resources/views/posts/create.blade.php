@extends('layouts.user')

@section('content')
<div class="container">
    <h2>新規投稿登録</h2>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <!-- 投稿種別 -->
        <div id="posts_image" class="preview text-center pt-sm-5 mb-3">
            <div class="mb-3">
                <img src="{{ asset('storage/images/posts_image.png')) }}" alt="image" width="100">
            </div>
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image">
        </div>
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- タイトル -->
        <div class="mb-3">
            <label class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <!-- 金額 -->
        <div class="mb-3">
            <label class="form-label">金額</label>
            <input type="text" name="amount" class="form-control" value="{{ old('amount') }}" required>
        </div>

        <!-- 内容 -->
        <div class="mb-3">
            <label class="form-label">内容</label>
            <textarea name="introduction" class="form-control" rows="5" required>{{ old('introduction') }}</textarea>
        </div>

        <!-- カテゴリ -->
        <div class="mb-3">
            <label class="form-label">カテゴリ</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-primary">投稿内容を確認する</button>
    </form>
</div>
@endsection
