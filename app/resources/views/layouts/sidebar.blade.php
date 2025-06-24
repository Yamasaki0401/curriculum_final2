
    <div class="sidebar position-sticky" style="top: 100px;">
        {{-- 使い方ガイド --}}
       <!-- <div class="mt-4">
            <a href="{{ route('guide') }}" class="btn btn-secondary w-100">
                はじめての方へ
            </a>
        </div>-->
        <div class="mt-4">
            <h5 class="mt-3">お手伝い・お願いの種類</h5>
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-2">
                    <a href="{{ route('search', ['keyword' => '料理']) }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/images/cooking.png') }}" alt="料理" style="max-width: 60px;" class="img-fluid">
                        <span class="fs-4">料理</span>
                    </a>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <a href="{{ route('search', ['keyword' => '掃除']) }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/images/clean.png') }}" alt="掃除" style="max-width: 60px;" class="img-fluid">
                        <span class="fs-4">掃除</span>
                    </a>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <a href="{{ route('search', ['keyword' => '裁縫']) }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/images/handicraft.png') }}" alt="裁縫" style="max-width: 60px;" class="img-fluid">
                        <span class="fs-4">裁縫</span>
                    </a>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <a href="{{ route('search', ['keyword' => '制作']) }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/images/crafts.png') }}" alt="制作" style="max-width: 60px;" class="img-fluid">
                        <span class="fs-4">裁縫</span>
                    </a>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <a href="{{ route('search', ['keyword' => 'ガーデニング']) }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/images/gardening.png') }}" alt="ガーデニング" style="max-width: 60px;" class="img-fluid">
                        <span class="fs-4">お庭</span>
                    </a>
                </li>
                <!-- 必要なカテゴリを追加 -->
            </ul>
        </div>

        {{-- みんなの声（口コミ） --}}
         <!--<h5 class="mt-4">みんなの声</h5>
        <ul class="list-unstyled">
            foreach($recentReviews as $review)
                 <li class="mb-2">
                     <strong>{ $review->user->name }}</strong><br>
                    <small>{ Str::limit($review->comment, 40) }}</small>
                </li>
            endforeach -->
        </ul>


    </div>

