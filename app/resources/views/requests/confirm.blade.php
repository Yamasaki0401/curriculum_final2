@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">新規お願い登録</h2>

    <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mx-auto" style="max-width: 600px;">
            <div class="card p-4 shadow-sm">
                <h4><strong>{{ session('request_data.title') }}</strong> / {{ $categoryName }}</h4>
                <div class="mb-3">
                    <label class="form-label">メールアドレス</label>
                    <p>{{ session('request_data.email') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">電話番号</label>
                    <p>{{ session('request_data.tel') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">希望日時</label>
                    <p>{{ session('request_data.deadline') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">内容</label>
                    <p>{{ session('request_data.request_detail') }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('requests.create') }}" class="btn btn-outline-secondary">編集に戻る</a>
                <button type="submit" class="btn btn-outline-primary">登録する</button>
            </div>
        </div>
    </form>
</div>
@endsection
