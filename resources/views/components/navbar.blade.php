<nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container position-relative">
        <div>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        {{-- 768px未満で表示 --}}
        @guest
        <ul class="u-sm-d-none u-d-flex u-mt-xs">
            <li>
                <a class="u-fw-bold u-px-xs" href="{{ route('login') }}">ログイン</a>
            </li>
            @if (Route::has('register'))
            <li>
                <a class="u-fw-bold u-px-xs" href="{{ route('register') }}">新規登録</a>
            </li>
            @endif
        </ul>
        @else
        <slide class="burger-slide u-sm-d-none u-d-block" right no-overlay width="200">
            <a href="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}">
                <span><i class="fas fa-user u-mr-sm"></i>プロフィール</span>
            </a>
            <a href="{{ route('community.plan.index') }}">
                <span><i class="fas fa-school u-mr-sm"></i>コミュニティ管理</span>
            </a>
            <a href="{{ route('chat.index') }}">
                <span><i class="fas fa-envelope u-mr-sm"></i>トークルーム</span>
            </a>
            <a href="{{ route('communities.likes') }}">
                <span><i class="fas fa-star u-mr-sm"></i>お気に入り</span>
            </a>
            <a href="{{ route('setting') }}">
                <span><i class="fas fa-cog u-mr-sm"></i>設定</span>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form--sp').submit();">
                <span><i class="fas fa-sign-out-alt u-tcd-red u-mr-sm"></i>ログアウト</span>
            </a>
            <form id="logout-form--sp" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </slide>
        @endguest

        {{-- 768px以上で表示 --}}
        <button class="navbar-toggler u-sm-d-block u-d-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item u-fs-sm" href="{{ route('setting') }}"><i class="fas fa-cog u-mr-sm"></i>設定</a>
                            <a class="dropdown-item u-fs-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt u-tcd-red u-mr-sm"></i>ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>