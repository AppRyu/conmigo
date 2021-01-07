@extends('layouts.app')

@section('title', 'コミュニティ一覧')

@section('content')
    <div class="community-container">
        <h2 class="page-tit u-mb-xl"><i class="fas fa-search u-mr-base"></i>コミュニティを探す
            <div class="u-fs-sm u-mt-xs">一緒に学習するコミュニティを探してください。</div>
        </h2>
        @foreach($communities as $community)
        <div class="community-content">
            <div class="community-content__left">
                <div class="community-flg">募集中</div>
            </div>
            <div class="community-content__right">
                <h3 class="community-name">
                    <a class="community-name__link" href="{{ route('community.show', ['community' => $community]) }}">
                        {{ $community->name }}
                    </a>
                </h3>
                <div class="community-times">
                    <div class="community-time"><span class="community-time__tag community-time__tag--start">開始日時</span><span class="d-inline-block">{{ $community->getDate($community->start) }} {{ $community->getTime($community->start) }}</span></div>
                    <div class="community-time"><span class="community-time__tag community-time__tag--end">終了日時</span><span class="d-inline-block">{{ $community->getDate($community->end) }} {{ $community->getTime($community->end) }}</span></div>
                </div>
                <div class="community-row">
                    <div class="community-requested">応募数<span class="community-requested__num">{{ $community->getTotalRecruitment() }}</span>件</div>
                    <div class="community-created-user"><a class="community-created-user__link" href="{{ route('user.show', ['user_name' => $community->users->user_name]) }}">{{ $community->users->user_name }}</a></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection