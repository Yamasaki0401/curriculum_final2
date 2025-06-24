@extends('layouts.user')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4">お手伝いの詳細内容</h2>

    <div class="card p-4 mx-auto" style="max-width: 800px; position: relative;">
        <!-- 投稿画像 -->
        @if($post->image)
        <div class="row g-3 align-items-start">
            <!-- 左：画像 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" style="max-width: 150px; height: auto;">
            </div>

            <!-- 右：投稿情報 -->
            <div class="col-md-8">
                <h4>タイトル：{{ $post->title }}</h4>
                <p><strong>お手伝いの種類：</strong>{{ $post->category ? $post->category->name : '未分類' }}</p>
                <p>費用：{{ $post->amount_label }}</p>
                <p>内容：{{ $post->introduction }}</p>

            </div>
        </div>
        @else
            <!-- 投稿情報 -->
            <h4>タイトル：{{ $post->title }}</h4>
            <p><strong>お手伝いの種類：</strong>{{ $post->category ? $post->category->name : '未分類' }}</p>
            <p>料金：{{ $post->amount_label }}</p>
            <p>内容：{{ $post->introduction }}</p>

        @endif
        @auth('web')
        <div class="mt-4 text-center">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commentModal-{{ $type }}-{{ $model->id }}">
                お手伝いする
            </button>
            <!-- <a href="{route('reviews.create', ['post' => $post->id]) }}" class="btn btn-outline-secondary">口コミを書く</a> -->
        </div>
        @endauth
    </div>
    <div class="d-flex justify-content-center gap-4">
        @auth('web')
            @if(auth()->guard('web')->id() === $post->user_id)
                <div class="mt-4"><a class="btn btn-primary" href="{{ route('posts.edit' , $post->id) }}">編集する</a></div>
                <div class="mt-4">
                    <form action="{{ route('posts.destroy' , $post->id) }}" method="POST" onsubmit="return confirm('削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">削除する</button>
                    </form>
                </div>
            @endif

        @endauth
    </div>
    @include('components.comments', ['post' => $post, 'type' => 'post'])

    <div class="d-flex justify-content-between mt-5 mb-3" style="margin-top: 200px;">
        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">一覧に戻る</a>
        @auth('web')
            @if (!$post->violationReports->contains('user_id', auth()->id()))
            <form method="POST" action="{{ route('posts.violation', $post->id) }}" onsubmit="return confirm('この投稿を報告しますか？')">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <button class="btn btn-outline-danger">違反報告</button>
            </form>
            @else
                <p class="text-danger">報告済みです。</p>
            @endif
        @endauth
    </div>


</div>
<script>
    function submitComment(event, url, type, id) {
        event.preventDefault();

        const form = event.target;
        const body = form.querySelector('textarea[name="body"]').value;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!body.trim()) return;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                type: type,
                id: id,
                body: body
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('サーバーエラー');

            return response.json();
        })
        .then(data => {
            if (data.success && data.commentHtml) {
                const list = document.getElementById(`comment-list-${type}-${id}`);
                list.insertAdjacentHTML('beforeend', data.commentHtml);
                form.reset();
            } else if (data.errors) {
                alert('入力内容に誤りがあります。');
                console.error(data.errors);
            } else {
                alert('コメントの投稿に失敗しました。');
            }
        })
        .catch(error => {
            console.error('通信エラー:', error);
            alert('通信エラーが発生しました');
        });


        return false;
    }
</script>
@endsection
