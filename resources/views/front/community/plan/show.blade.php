@extends('layouts.app')

@section('title', '企画したコミュニティ詳細')

@section('content')
    <section>
        <h2 class="page-tit u-mb-xl"><i class="fas fa-users u-mr-base"></i>ユーザー選択</h2>
        <h3 class="u-fs-xl u-fw-bold u-mb-lg">{{ $community->name }}</h3>
        <div class="u-mb-lg">
            @include('./modules/timeTable', [
                                                'startDate' => $community->getDate($community->start), 
                                                'startTime' => $community->getTime($community->start), 
                                                'endDate' => $community->getDate($community->end), 
                                                'endTime' => $community->getTime($community->end),
                                                'num' => $community->number,
                                            ])
        </div>
        <section class="comm-det-desc u-mb-lg">
            <h4 class="comm-det-desc__hd u-mb-base"><span class="comm-det-desc__hd_emphasis">コミュニティの詳細</span></h4>
            <div class="comm-det-desc__cmt">{!! nl2br(e($community->detail)) !!}</div>
        </section>
        <p class="u-mb-base">学習する仲間を<span class="max-select-user u-mx-xs">{{ $community->number }}</span>人<span class="{{ ($community->number === 1) ? 'u-d-none' : 'u-d-inline' }}">まで</span>選択してください。</p>
        <form action="{{ route('community.plan.determineUser', ['community' => $community]) }}" method="post">
            @csrf
            <community-select-user :applied-users={{ $appliedUsers }}
                                    :max-users-number="{{ $community->number }}"></community-select-user>
        </form>
    </section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection