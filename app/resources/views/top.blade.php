@extends('layouts.user')

@section('content')
<div class="container">
    <div class="card text-bg-white border border-0">
        <img src="{{ asset('storage/images/top_image.png') }}" class="card-img" alt="..." style="height: 400px">
    </div>
     <!-- 検索欄 -->
    <div class="container-sm mb-2 pt-sm-5">
        <form class="row border mx-auto p-5 rounded-3 bg-primary-subtle" role="search">
            <h4 for="search" class="form-title text-center">検索</h4>
            <form method="GET" action="{{ route('search') }}">
                <div class="form-group d-flex">
                    <input type="search" name="keyword" class="form-control me-2" placeholder="検索..." aria-label="検索...">
                    <button type="submit" class="btn btn-outline-primary flex-shrink-0"><i class="bi bi-search"></i>検索</button>
                </div>
            </form>
        </form>
    </div>


    <!-- タブ切り替え -->
    <ul class="nav nav-tabs mb-3 justify-content-center" id="mypageTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab">お手伝いの投稿</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests" type="button" role="tab">お願いの投稿</button>
        </li>
    </ul>



    <!-- タブ内容 -->
    <div class="tab-content" id="mypageTabContent">
        <!-- 投稿タブ -->
        <div class="tab-pane fade show active" id="posts" role="tabpanel">
            <div class="text-end mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">お手伝いを登録する</a>
            </div>

            @if($posts->isEmpty())
                <p>投稿はまだありません。</p>
            @else
            <div class="container mb-4">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
                    @foreach($posts as $post)
                    <a href="{{ route('posts.detail', $post->id) }}" class="col text-decoration-none">
                        <div class="card h-100" style="width: 12rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>料金：{{ $post->amount_label }}</p>
                                <p class="card-text">{{ $post->introduction }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach

                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>

        <!-- 依頼タブ　 -->
        <div class="tab-pane fade" id="requests" role="tabpanel">
            <div class="text-end mb-3">
                <a href="{{ route('requests.create') }}" class="btn btn-outline-primary">お願いを登録する</a>
            </div>
            @if($requests->isEmpty())
                <p>依頼はまだありません。</p>
            @else
            <div class="container mb-4">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">
                    @foreach ($requests as $request)
                    <div class="col">
                        <a href="{{ route('requests.detail', $request->id) }}" class="text-decoration-none">
                            <div class="card h-100" style="width: 12rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $request->title }}</h5>
                                    <p class="card-text"> {{ Str::limit($request->request_detail, 100) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $requests->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection


