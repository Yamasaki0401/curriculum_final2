
    <div class="sidebar position-sticky" style="top: 100px;">
        {{-- 使い方ガイド --}}
        <div class="mt-4">
            <a href="{{ route('guide') }}" class="btn btn-secondary w-100">
                はじめての方へ
            </a>
        </div>
        <div class="mt-4">
            <h6>お手伝いの種類</h6>
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-2">
                <img src="{{ asset('storage/images/cooking.png') }}" alt="料理" style="max-width: 60px;" class="img-fluid"> 料理
                </li>
                <li class="d-flex align-items-center mb-2">
                <img src="{{ asset('storage/images/clean.png') }}" alt="掃除" style="max-width: 60px;" class="img-fluid"> 掃除
                </li>
                <li class="d-flex align-items-center mb-2">
                <img src="{{ asset('storage/images/handicraft.png') }}" alt="裁縫" style="max-width: 60px;" class="img-fluid"> 裁縫
                </li>
                <li class="d-flex align-items-center mb-2">
                <img src="{{ asset('storage/images/crafts.png') }}" alt="制作" style="max-width: 60px;" class="img-fluid"> 制作
                </li>
                <li class="d-flex align-items-center mb-2">
                <img src="{{ asset('storage/images/gardening.png') }}" alt="ガーデニング" style="max-width: 60px;" class="img-fluid"> ガーデニング
                </li>
                <!-- 必要なカテゴリを追加 -->
            </ul>
        </div>

        {{-- みんなの声（口コミ） --}}
        <h5 class="mt-4">みんなの声</h5>
        <ul class="list-unstyled">
            <!-- foreach($recentReviews as $review)
                 <li class="mb-2">
                     <strong>{ $review->user->name }}</strong><br>
                    <small>{ Str::limit($review->comment, 40) }}</small>
                </li>
            endforeach -->
        </ul>

        {{-- お問い合わせ窓口 --}}
        <div class="mt-2">
            <!--  <a href="{ route('contact') }}" class="btn btn-outline-secondary w-100"> -->
            ご相談・ご連絡
        </a>
        </div>
    </div>

