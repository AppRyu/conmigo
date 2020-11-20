<div class="sidebar">
    <div class="profile-img">
        <img src="./img/default-icon.png" alt="">
    </div>
    <div class="profile-name">
        <div class="profile-name__user">
            <a href="">{{ Auth::user()->name }}</a>
        </div>
        <div class="profile-name__id">{{ Auth::user()->user_name }}</div>
    </div>
    <div class="profile-data">
        <div class="profile-intro">
            <a class="profile-data__link" href="{{ route('user.show', ['user_name' => Auth::user()->user_name ]) }}">基本データ</a>
        </div>
        <div class="profile-community">
            <a class="profile-data__link" href="">コミュニティ</a>
        </div>
    </div>
</div>