@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">お願い内容の編集</h2>

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

    <form method="POST" action="{{ route('requests.update' ,  ['request' => $requestModel->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card p-4 mx-auto" style="max-width: 600px;">
            <div class="mb-3">
                <label class="form-label">タイトル</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title' , '$requestModel->title') }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">ステータス</label>
                <select name="status" class="form-select">
                  @foreach(App\Models\Request::$statusOptions as $key => $label)
                    <option value="{{ $key }}" {{ $requestModel->status == $key ? 'selected' : '' }}>
                      {{ $label }}
                    </option>
                  @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">お願いの種類</label>
                <select name="category_id" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $requestModel->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">メールアドレス</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email' , '$requestModel->email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">電話番号</label>
                <input type="text" name="tel" class="form-control" required value="{{ old('tel') , '$requestModel->tel'}}">
            </div>

            <div class="mb-3">
                <label class="form-label">内容</label>
                <textarea name="request_detail" class="form-control" rows="4" required>{{ old('request_detail' , '$requestModel->request_detail') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">希望日時</label>
                <input type="date" name="deadline" class="form-control" required value="{{ old('deadline' , '$requestModel->deadline') }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary">更新する</button>
            </div>
        </div>
    </form>
</div>
@endsection
