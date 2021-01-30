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
            <a class="sidebar-data__link" href="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}"><i class="fas fa-user u-mr-sm"></i>プロフィール</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('community.plan.index') }}"><i class="fas fa-school u-mr-sm"></i>コミュニティ管理</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('chat.index') }}"><i class="fas fa-comments u-mr-base"></i>チャットルーム</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('message.index') }}"><i class="fas fa-envelope u-mr-sm"></i>メッセージ</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('communities.likes') }}"><i class="fas fa-star u-mr-sm"></i>お気に入り</a>
        </div>
        <div>
            <a class="sidebar-data__link" href="{{ route('setting') }}"><i class="fas fa-cog u-mr-sm"></i>設定</a>
        </div>
    </div>
</div>