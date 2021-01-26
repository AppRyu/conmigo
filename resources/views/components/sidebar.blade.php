<div class="sidebar">
    <div class="profile-img">
        @if(Auth::user()->profile_image !== null)
        <img src="{{ asset('/storage/img/'.Auth::user()->profile_image) }}" alt="プロフィール画像">
        @else
        <img src="{{ asset('./img/default-icon.png') }}" alt="プロフィール画像">
        @endif
    </div>
    <div class="profile-name">
        <div class="profile-name__user">
            <a href="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}">{{ Auth::user()->name }}</a>
        </div>
        <div class="profile-name__id">&#040;ユーザー名：{{ Auth::user()->user_name }}&#041;</div>
        <div>
            <a class="u-fs-xs u-mr-sm" href="{{ url('follows/following') }}"><span class="u-fw-bold u-fs-base u-mr-xs">{{ Auth::user()->count_followings }}</span>フォロー中</a>
            <a class="u-fs-xs" href="{{ url('follows/follower') }}"><span class="u-fw-bold u-fs-base u-mr-xs">{{ Auth::user()->count_followers }}</span>フォロワー</a>
        </div>
    </div>
    <div class="sidebar-data">
        <div>
            <a class="sidebar-data__link" href="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}">プロフィール</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('community.plan.index') }}">コミュニティ管理</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('chat.index') }}">トークルーム</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('communities.likes') }}">お気に入り</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('setting') }}">設定</a>
        </div>
    </div>
</div>