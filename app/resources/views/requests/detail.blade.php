@extends('layouts.user')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4">お願いの詳細内容</h2>

    <div class="card p-4 mx-auto" style="max-width: 800px; position: relative;">

        <!-- 投稿情報 -->
        <h4 class="d-flex align-items-center">
            タイトル：{{ $requestModel->title }}
            <span class="badge ms-2 align-middle
                @if ($requestModel->status == '掲載中') bg-primary
                @elseif ($requestModel->status == '進行中') bg-warning text-dark
                @elseif ($requestModel->status == '完了') bg-success
                @endif">
                {{ $requestModel->status }}
            </span>
        </h4>
        <p><strong>お手伝いの種類：</strong>{{ $requestModel->category ? $requestModel->category->name : '未分類' }}</p>
        <p>内容：{{ $requestModel->request_detail }}</p>

        <div class="mt-4 text-center">
            @if($requestModel->status === '掲載中' || $requestModel->status === '進行中')

                <!-- コメントモーダル起動ボタン -->
                @auth('web')
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commentModal-{{ $type }}-{{ $model->id }}">
                    お手伝いする
                </button>
                @endauth
            @elseif($requestModel->status === '完了')
                <span class="badge bg-secondary">受付終了</span>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center gap-4">
        @auth('web')
            @if(auth()->guard('web')->id() === $requestModel->user_id)
                @if($requestModel->status === '掲載中')
                    <a href="{{ route('requests.edit', $requestModel->id) }}" class="btn btn-outline-secondary">編集</a>

                    <form action="{{ route('requests.destroy', $requestModel->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">削除</button>
                    </form>
                @endif

            @elseif($requestModel->status === '完了')
                 <span class="badge bg-secondary">終了</span>
            @endif

        @endauth
    </div>

    @include('components.comments', ['requestModel' => $requestModel, 'type' => 'request'])

    <div class="d-flex justify-content-between mt-5 mb-3" style="margin-top: 200px;">
        <a href="{{ route('requests.index') }}" class="btn btn-outline-primary">一覧に戻る</a>
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
        .then(response => response.json())
        .then(data => {
            if (data.success && data.commentHtml) {
                const list = document.getElementById(`comment-list-${type}-${id}`);
                list.insertAdjacentHTML('beforeend', data.commentHtml);
                form.reset();
            } else {
                alert('コメントの投稿に失敗しました。');
            }
        })
        .catch(() => {
            alert('通信エラーが発生しました。');
        });

        return false;
    }
</script>
@endsection
