@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">新規お手伝い登録</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.confirm') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">

            <div id="posts_image" class="preview text-center pt-sm-5 mb-3">
                <div class="md-4 text-center mb-3">
                    <img id="preview" src="{{ asset('storage/images/posts_image.png') }}" alt="image" class="img-thumbnail mb-2" style="max-width: 100%; height: auto;">
                    <input type="file" name="image" class="form-control mt-2 @error('image') is-invalid @enderror" onchange="previewImage(event)">
                </div>
            </div>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- タイトル -->
                <div class="card p-4 shadow-sm">
                    <div class="mb-3">
                        <label class="form-label">タイトル</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <!-- 金額　-->
                    <div class="mb-3">
                        <label class="form-label">費用の設定</label>
                        <select name="amount" class="form-select" required>
                            <option value="">選択してください</option>
                            <option value="0" {{ old('amount') == "0" ? 'selected' : '' }}>不要</option>
                            <option value="1" {{ old('amount') == "1" ? 'selected' : '' }}>要相談</option>
                        </select>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div


                    <!-- 内容 -->
                    <div class="mb-3">
                        <label class="form-label">内容</label>
                        <textarea name="introduction" class="form-control" rows="5" required>{{ old('introduction') }}</textarea>
                    </div>

                    <!-- カテゴリ -->
                    <div class="mb-3">
                        <label class="form-label">お手伝いの種類</label>
                        <select name="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">投稿内容を確認する</button>
                </div>
            </div>
    </form>
</div>
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
