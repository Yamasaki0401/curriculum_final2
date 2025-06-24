<div class="container mb-4">
    <div class="row row-cols-5 g-5 pt-sm-5">
        @foreach ($requests as $request)
        <a href="{{ route('requests.detail', $request->id) }}" class="col text-decoration-none">
            <div class="card h-100" style="width: 12rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $request->title }}</h5>
                    <p class="card-text"> {{ Str::limit($request->request_detail, 100) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
