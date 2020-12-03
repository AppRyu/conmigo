@extends('layouts.app')

@section('title', 'コミュニティ一覧')

@section('content')
        <div class="community-container">
            <a class="community-content__link" href="{{ route('community.show', ['id' => 3]) }}">
                <div class="community-content">
                    <div class="community-content__left">
                        <div class="community-flg">募集中<br>あと3人</div>
                    </div>
                    <div class="community-content__right">
                        <h3 class="community-name">駆け出しエンジニアもくもく会</h3>
                        <div class="community-time"><span class="community-time__head">日時</span>2020年3月14日15:00~17:00</div>
                        <div class="community-row">
                            <div class="community-requested">応募数<span class="community-requested__num">3</span>件</div>
                            <div class="community-created-user"><a class="community-created-user__link" href="">appryu_0722</a></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
@endsection
    
@section('sidebar')
        @auth
            <!-- プロフィールサイドバー -->
            @include('./components/sidebar')
        @endauth
@endsection