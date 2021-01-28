<nav class="navbar navbar-expand-md navbar-light">
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
                <a class="u-px-xs" href="{{ route('login') }}">ログイン</a>
            </li>
            @if (Route::has('register'))
            <li>
                <a class="u-px-xs" href="{{ route('register') }}">新規登録</a>
            </li>
            @endif
        </ul>
        @else
        <vue-burger-menu    :csrf="{{json_encode(csrf_token())}}"
                            profile-url="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}"
                            community-plan-url="{{ route('community.plan.index') }}"
                            chat-room-url="{{ route('chat.index') }}"
                            community-likes-url="{{ route('communities.likes') }}"
                            setting-url="{{ route('setting') }}"
                            logout-url="{{ route('logout') }}"
        ></vue-burger-menu>
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