@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4 mt-2">登録内容確認</h2>
            <div class="card">
                <div class="container">


                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <!-- アバター画像 -->
                        <div id="posts_image" class="preview text-center mb-4 mt-2">
                            <div class="text-center mb-4">
                                <img id="preview" src="{{ session('register_data.avatar') ?? asset('storage/images/user_default.jpg') }}" alt="avatar_mage" style="max-width: 100px;">
                            </div>
                        </div>

                        <!-- 名前 -->
                        <div class="mb-3">
                            <label for="name" class="form-label">名前</label>
                            <input type="text" name="name" class="form-control" value="{{ session('register_data.name') ?? '' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">住所（市区町村）</label>
                            <input type="text" name="city" class="form-control" value="{{ session('register_data.city') ?? '' }}" readonly>
                        </div>

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" name="email" class="form-control" value="{{ session('register_data.email') ?? '' }}" readonly>
                        </div>
                         <div class="d-flex justify-content-around mb-3">
                            <a href="{{ route('register') }}" class="btn btn-secondary">戻る</a>
                            <button type="submit" class="btn btn-primary">登録する</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
