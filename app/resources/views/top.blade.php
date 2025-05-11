@extends('layouts.user')

@section('content')
<div class="container">
    <div class="card text-bg-white border border-0">
        <img src="{{ asset('storage/images/top_image.png') }}" class="card-img" alt="..." style="height: 400px">
    </div>
    <div class="container">
        <div class="row row-cols-5 g-5 pt-sm-5">
            <a href="#" class="col text-decoration-none">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </a>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 検索欄 -->
    <div class="container-sm mb-2 pt-sm-5">
        <form class="row border mx-auto p-5 rounded-3 bg-primary-subtle" role="search">
            <h4 for="search" class="form-title text-center">検索</h4>
            <div class="form-group d-flex">
                <input type="search" class="form-control me-2" placeholder="検索..." aria-label="検索...">
                <button type="submit" class="btn btn-outline-primary flex-shrink-0"><i class="bi bi-search"></i>検索</button>
            </div>
        </form>
    </div>
    <!-- 口コミ投稿 -->
    <div class="row row-cols-5 g-5 pt-sm-5 mb-2">
            <div class="col">
                <a href="#" class="col text-decoration-none">
                    <div class="card h-100" style="width: 12rem;">
                        <div class="row mx-2 mt-3">
                            <div class="col">
                                <img src="{{ asset('storage/user_default.jpg') }}" class="card-img-top" alt="avatar" width="5" height="40">
                            </div>
                            <div class="col">
                                <h6 class="card-title">Card title</h6>
                            </div>

                        </div>
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="width: 12rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection


