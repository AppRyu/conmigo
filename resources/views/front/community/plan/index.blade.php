@extends('layouts.app')

@section('title', '企画したコミュニティ一覧')

@section('content')
<section>
    <h2 class="page-tit u-mb-xl"><i class="fas fa-school u-mr-base"></i>企画済コミュニティ</h2>
    <div class="ca-navTabs">
        <a class="ca-navTabs__item ca-navTabs__item_active" href="{{ route('community.plan.index') }}">企画した</a>
        <a class="ca-navTabs__item" href="{{ route('community.applied') }}">応募した</a>
    </div>
    <div class="u-mb-lg">
        @if(!$communities->count())
        <div class="container">
            <div class="community-search__tit u-mb-base">
                <span class="community-search__tit--nowrap">企画したコミュニティはありません。</span>
                <span class="community-search__tit--nowrap">コミュニティを作成は<a class="c-link-blue" href="{{ route('community.create') }}">こちら</a></span>
            </div>
            <div class="community-search__img"><img src="{{ asset('./img/create-community.svg') }}" alt=""></div>
        </div>
        @endif
        @foreach($communities as $community)
            <div class="community-content u-xs-d-flex">
                <div class="community-content__left u-d-none u-xs-d-block u-xs-mr-base">
                    @if($community->isPast($community->start))
                    <div class="community-badge c-badge-base c-badge-red">締切</div>
                    @elseif($community->members->where('community_id', $community->id)->count())
                    <div class="community-badge c-badge-base c-badge-blue">満員</div>
                    @else
                    <div class="community-badge c-badge-base c-badge-green">募集中</div>
                    @endif
                </div>
                @if($community->isPast($community->start))
                <div class="community-badge-sm community-badge-sm--red u-d-block u-xs-d-none"><span class="community-badge-sm__txt">締切</span></div>
                @elseif($community->members->where('community_id', $community->id)->count())
                <div class="community-badge-sm community-badge-sm--blue u-d-block u-xs-d-none"><span class="community-badge-sm__txt">満員</span></div>
                @else
                <div class="community-badge-sm community-badge-sm--green u-d-block u-xs-d-none"><span class="community-badge-sm__txt">募集中</span></div>
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
                    <div class="community-plan-settings">
                        <div class="u-mr-sm"><a class="c-link-blue" href="{{ route('community.plan.show', ['community' => $community]) }}">仲間を選択する</a></div>
                        <div class="u-mr-sm"><a class="c-link-green" href="{{ route('community.edit', ['community' => $community]) }}">編集する</a></div>
                        <form class="community-destroy-form" action="{{ route('community.destroy', ['community' => $community]) }}" method="post">
                            @csrf
                            @method('delete')
                            <input class="community-destroy-form__input c-link-red" type="submit" value="削除する" onclick="return confirm('削除しますか？')">
                        </form>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
    <!-- ページネーションリンク -->
    {{ $communities->links('vendor.pagination.bootstrap-4') }}
</section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection