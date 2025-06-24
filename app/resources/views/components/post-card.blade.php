<div class="container mb-4">
    <div class="row row-cols-5 g-5 pt-sm-5">
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
    </div
