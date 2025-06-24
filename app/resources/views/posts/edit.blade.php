@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">お手伝い内容の編集</h2>

    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">

            <div id="posts_image" class="preview text-center pt-sm-5 mb-3">
                <div class="md-4 text-center mb-3">
                    @if($post->image)
                    <img id="preview" src="{{ Storage::url($post->image) }}" class="img-thumbnail mt-2" style="max-width: 100%; height: auto;">
                    @endif
                    <input type="file" name="image" class="form-control mt-2 @error('image') is-invalid @enderror" onchange="previewImage(event)">
                </div>
            </div>

            <!-- タイトル -->
                <div class="card p-4 shadow-sm">
                    <div class="mb-3">
                        <label class="form-label">タイトル</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title' , $post->title) }}" required>
                    </div>

                    <!-- 金額 -->
                    <div class="mb-3">
                        <label class="form-label">費用</label>
                        <select name="amount" class="form-select">
                            <option value="" {{ old('amount') === '0' ? 'selected' : '' }}>不要</option>
                            <option value="要相談" {{ old('amount') === '1' ? 'selected' : '' }}>要相談</option>
                        </select>
                    </div


                    <!-- 内容 -->
                    <div class="mb-3">
                        <label class="form-label">内容</label>
                        <textarea name="introduction" class="form-control" rows="5" required>{{ old('introduction' , $post->introduction) }}</textarea>
                    </div>

                    <!-- カテゴリ -->
                    <div class="mb-3">
                        <label class="form-label">お手伝いの種類</label>
                        <select name="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">内容を更新する</button>
                </div>
            </div>
    </form>
    <div class="d-flex justify-content-between mt-5 mb-3" style="margin-top: 200px;">
        <a href="{{ route('posts.detail' , $post->id) }}" class="btn btn-outline-primary">戻る</a>
    </div>
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
