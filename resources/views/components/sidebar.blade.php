<div class="sidebar">
    <div class="profile-img">
        @if(Auth::user()->profile_image !== null)
        <img src="{{ asset('/storage/img/'.Auth::user()->profile_image) }}" alt="プロフィール画像">
        @else
        <img src="./img/default-icon.png" alt="プロフィール画像">
        @endif
    </div>
    <div class="profile-name">
        <div class="profile-name__user">
            <a href="">{{ Auth::user()->name }}</a>
        </div>
        <div class="profile-name__id">&#040;ユーザー名：{{ Auth::user()->user_name }}&#041;</div>
    </div>
    <div class="profile-data">
        <div class="profile-intro">
            <a class="profile-data__link" href="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}">基本データ</a>
        </div>
        <div class="profile-community">
            <a class="profile-data__link" href="{{ route('community.planed', ['user_name' => Auth::user()->user_name]) }}">コミュニティ管理</a>
        </div>
    </div>
</div>