@extends('layouts.app')

@section('title', 'コミュニティ一覧')

@section('content')
    <div class="community-container">
        @foreach($communities as $community)
        <div class="community-content">
            <div class="community-content__left">
                <div class="community-flg">募集中</div>
            </div>
            <div class="community-content__right">
                <a class="community-content__link" href="{{ route('community.show', ['id' => $community->id]) }}">
                    <h3 class="community-name">{{ $community->name }}</h3>
                </a>
                <div class="community-times">
                    <div class="community-time"><span class="community-time__head community-time__head--start">開始日時</span><span class="d-inline-block">{{ $community->getDate($community->start_time) }}</span><span class="d-inline-block">{{ $community->getTime($community->start_time) }}</span></div>
                    <div class="community-time"><span class="community-time__head community-time__head--end">終了日時</span><span class="d-inline-block">{{ $community->getDate($community->end_time) }}</span><span class="d-inline-block">{{ $community->getTime($community->end_time) }}</span></div>
                </div>
                <div class="community-row">
                    <div class="community-requested">応募数<span class="community-requested__num">3</span>件</div>
                    <div class="community-created-user"><a class="community-created-user__link" href="{{ route('user.show', ['user_name' => $community->created_user]) }}">{{ $community->created_user }}</a></div>
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