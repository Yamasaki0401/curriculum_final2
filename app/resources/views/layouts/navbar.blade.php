<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                   <!--  <a class="nav-link active" aria-current="page" href="#">ご近所さんについて</a> -->
                                    <a class="nav-link" href="{{ route('posts.index')}}">お手伝い一覧</a>
                                     <a class="nav-link" href="{{ route('requests.index')}}">お願い一覧</a>
                                    <a class="nav-link" href="{{ route('search') }}">検索する</a>
                                </div>
                        </div>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @endguest
                        @auth('web')
                            <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mypage.index') }}">{{ Auth::user()->name }}さんのマイページ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        @endauth
</div>
