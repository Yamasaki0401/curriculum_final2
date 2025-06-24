@extends('layouts.user')

@section('content')
<form method="GET" action="{{ route('search') }}" class="mb-4">
    {{-- キーワード入力 --}}
    <div class="mb-3">
        <input type="search" name="keyword" class="form-control form-control-lg"
               placeholder="キーワードを入力..." value="{{ request('keyword') }}">
    </div>

    {{-- フィルター群 --}}
    <div class="row g-3 align-items-end">
        {{-- カテゴリ --}}
        <div class="col-md-4">
            <label for="category" class="form-label">お手伝い・お願いの種類</label>
            <select name="category" id="category" class="form-select">
                <option value="">すべて</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 近所フィルター --}}
        <div class="col-md-4">
            <label for="nearby" class="form-label">近所のみ</label>
            <select name="nearby" id="nearby" class="form-select">
                <option value="">すべて</option>
                <option value="1" {{ request('nearby') == '1' ? 'selected' : '' }}>近所のみ</option>
            </select>
        </div>

        {{-- 投稿 or 依頼 --}}
        <div class="col-md-4">
            <label for="type" class="form-label">お手伝いまたはお願い</label>
            <select name="type" id="type" class="form-select">
                <option value="">すべて</option>
                <option value="post" {{ request('type') == 'post' ? 'selected' : '' }}>お手伝い</option>
                <option value="request" {{ request('type') == 'request' ? 'selected' : '' }}>お願い</option>
            </select>
        </div>
    </div>

    {{-- 検索ボタン --}}
    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-search"></i> 検索する
        </button>
    </div>
</form>

<div class="container">
    @if($posts->isNotEmpty())
        <h3>お手伝い一覧</h3>
        @foreach($posts as $post)
            @include('components.post-card', ['post' => $post])
        @endforeach
    @endif

    @if($requests->isNotEmpty())
        <h3>お願い一覧</h3>
        @foreach($requests as $request)
            @include('components.request-card', ['request' => $request])
        @endforeach
    @endif

    @if($posts->isEmpty() && $requests->isEmpty())
        <p class="text-muted">該当する投稿・依頼は見つかりませんでした。</p>
    @endif
</div>
@endsection
