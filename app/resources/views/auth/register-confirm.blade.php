@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="container">
                    <h1>登録内容確認</h1>

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <!-- アバター画像 -->
                        <div class="mb-3">
                             @if (session('avatar'))
                                <img src="{{ asset('storage/images' . session('avatar')) }}" alt="アバター" width="100">
                            @else
                                <img src="{{ asset('storage/images/user_default.jpg') }}" alt="デフォルトアバター" width="100">
                            @endif
                        </div>

                        <!-- 名前 -->
                        <div class="mb-3">
                            <label for="name" class="form-label">名前</label>
                            <input type="text" name="name" class="form-control" value="{{ session('register_data')['name'] ?? '' }}" readonly>
                        </div>

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" name="email" class="form-control" value="{{ session('register_data')['email'] ?? '' }}" readonly>
                        </div>




                        <button type="submit" class="btn btn-primary">登録する</button>
                    </form>

                    <a href="{{ route('register') }}" class="btn btn-secondary">戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
