@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.confirm') }}" enctype="multipart/form-data">
                        @csrf

                        <div id="avatar_preview" class="preview text-center pt-sm-5 mb-3">
                           <div class="mb-3">
                                <img src="{{ old('avatar') ? old('avatar') : (session('avatar') ? asset('storage/images/' . session('avatar')) : asset('storage/images/user_default.jpg')) }}" alt="アバター" width="100">
                            </div>
                            <input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar" id="avatar">
                        </div>
                        @error('avatar')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ユーザー名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ session('register_data.name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ session('register_data.email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード確認') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary rounded-pill">
                                    {{ __('入力内容の確認') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // 画像が選択されたらプレビューを表示
    document.getElementById('avatar').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const avatarPreview = document.getElementById('avatar_preview');
            avatarPreview.innerHTML = `<img src="${reader.result}" id="avatar_img" alt="Avatar" width="100" height="100">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection

