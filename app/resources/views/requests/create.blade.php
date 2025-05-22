@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">新規依頼登録</h2>

    <form method="POST" action="{{ route('requests.confirm') }}">
        @csrf
        <div class="card p-4 mx-auto" style="max-width: 600px;">
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
                <textarea name="body" class="form-control" rows="4" required>{{ old('body') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">希望納期</label>
                <input type="text" name="deadline" class="form-control" required value="{{ old('deadline') }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary">登録内容確認</button>
            </div>
        </div>
    </form>
</div>
@endsection
