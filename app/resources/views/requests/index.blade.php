@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row col-md-10 px-4">
            <h2 class="text-center mt-5">お願い一覧</h2>
            <form method="GET" action="{{ route('requests.index') }}" class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="nearby" value="1" id="nearbyCheck"
                        {{ request('nearby') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="nearbyCheck">
                        近所のみ表示
                    </label>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-2">絞り込む</button>
            </form>

            <div class="row row-cols-6 row-cols-sm-4 g-5">
                @foreach ($requests as $request)
                    <div class="card mb-3 shadow-sm me-2" style="background-color: #FAF8F0; border: 1px solid #E8E1C1;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $request->title }}</h5>
                            <p class="mb-1"><strong>お手伝いの種類：</strong>{{ $request->category->name }}</p>
                            <p class="card-text">{{ Str::limit($request->request_detail, 60) }}</p>
                            <a href="{{ route('requests.detail', $request->id) }}" class="btn btn-outline-primary mt-auto w-100">詳しく見る</a>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $requests->links() }}
           </div>
    </div>
</div>
@endsection
