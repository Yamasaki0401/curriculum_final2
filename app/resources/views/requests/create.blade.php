@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">新規お願い登録</h2>

    {{-- エラーメッセージ表示 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('requests.confirm') }}" enctype="multipart/form-data">
        @csrf
        <div class="card p-4 mx-auto" style="max-width: 600px;">
            <div class="mb-3">
                <label class="form-label">タイトル</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">お願いの種類</label>
                <select name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">メールアドレス</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">電話番号</label>
                <input type="text" name="tel" class="form-control" required value="{{ old('tel') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">内容</label>
                <textarea name="request_detail" class="form-control" rows="4" required>{{ old('request_detail') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">希望日時</label>
                <input type="date" name="deadline" class="form-control" required value="{{ old('deadline') }}">
            </div>

            <input type="hidden" name="status" value="掲載中">
            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary">内容の確認</button>
            </div>
        </div>
    </form>
</div>
@endsection
