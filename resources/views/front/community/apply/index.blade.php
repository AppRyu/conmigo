@extends('layouts.app')

@section('title', '応募したコミュニティ一覧')

@section('content')
<section>
    <h2 class="page-tit u-mb-xl">
        <i class="fas fa-file-signature u-mr-base"></i>応募済コミュニティ
        <div class="u-fs-sm u-fw-normal u-mt-xs">当選の表示がついているものは、チャットルームにアクセスできます。</div>
    </h2>
    <div class="community-admin-navTabs">
        <a class="community-admin-navTabs__item" href="{{ route('community.plan.index') }}">企画した</a>
        <a class="community-admin-navTabs__item community-admin-navTabs__item_active" href="{{ route('community.applied') }}">応募した</a>
    </div>
    <div class="u-mb-lg">
        @if(!$communities->count())
        <div class="container">
            <div class="community-search__tit u-mb-base">
                <span class="community-search__tit--nowrap">応募したコミュニティはありません。</span>
                <span class="community-search__tit--nowrap">コミュニティを探すは<a class="c-link-blue" href="{{ route('community.index') }}">こちら</a></span>
            </div>
            <div class="community-search__img"><img src="{{ asset('./img/search-community.svg') }}" alt=""></div>
        </div>
        @endif
        @foreach($communities as $community)
            <div class="community-content u-xs-d-flex">

                <!-- 576px以上で表示 -->
                <div class="community-content__left u-d-none u-xs-d-block u-xs-mr-base">
                    @if($community->members->where('user_id', Auth::user()->id)->count())
                    <div class="community-badge c-badge-base c-badge-blue">当選</div>
                    @elseif($community->members->where('community_id', $community->id)->count())
                    <div class="community-badge c-badge-base c-badge-red">落選</div>
                    @else
                    <div class="community-badge c-badge-base c-badge-green">選考中</div>
                    @endif
                </div>

                <!-- 575px以下で表示 -->
                @if($community->members->where('user_id', Auth::user()->id)->count())
                <div class="community-badge-sm community-badge-sm--blue u-d-block u-xs-d-none"><span class="community-badge-sm__txt">当選</span></div>
                @elseif($community->members->where('community_id', $community->id)->count())
                <div class="community-badge-sm community-badge-sm--red u-d-block u-xs-d-none"><span class="community-badge-sm__txt">落選</span></div>
                @else
                <div class="community-badge-sm community-badge-sm--green u-d-block u-xs-d-none"><span class="community-badge-sm__txt">選考中</span></div>
                @endif

                <section class="community-content__right">
                    <h3 class="u-c---dark-blue u-fs-lg u-ml-base u-xs-ml-no u-mb-sm">
                        <a class="c-link-blue" href="{{ route('community.show', ['community' => $community]) }}">{{ $community->name }}</a>
                        @if(Auth::check())
                        <community-like
                        :initial-is-liked-by='@json($community->isLikedBy(Auth::user()))'
                        :authorized='@json(Auth::check())'
                        endpoint="{{ route('communities.like', ['community' => $community]) }}"
                        >
                        </community-like>
                        @endif
                    </h3>
                    <div class="u-md-d-flex">
                        <div class="u-fw-bold u-mb-xs u-md-mr-base u-md-mb-no"><span class="c-tag-sm c-tag-red u-mr-sm">開始日時</span><span class="d-inline-block u-fs-sm">{{ $community->getDate($community->start) }} {{ $community->getTime($community->start) }}</span></div>
                        <div class="u-fw-bold"><span class="c-tag-sm c-tag-green u-mr-sm">終了日時</span><span class="d-inline-block u-fs-sm">{{ $community->getDate($community->end) }} {{ $community->getTime($community->end) }}</span></div>
                    </div>
                    <div class="community-row u-mb-xs">
                        <div class="u-fs-sm">応募数<span class="u-c---dark-blue u-fs-xl u-mx-sm">{{ $community->getTotalRecruitment() }}</span>件</div>
                        <div class="u-d-flex">
                            @if ($community->users->profile_image)
                            <div class="c-icon-xs u-mr-xs"><img src="{{ asset('/storage/img/'.$community->users->profile_image) }}" alt="コミュニティ作成したユーザー画像"></div>
                            @else
                            <div class="c-icon-xs u-mr-xs"><img src="{{ asset('./img/default-icon.png') }}" alt="コミュニティ作成したユーザー画像"></div>
                            @endif
                            <a class="community-created-user__link" href="{{ route('user.show', ['user_name' => $community->users->user_name]) }}">{{ $community->users->user_name }}</a>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
</section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection