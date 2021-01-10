@extends('layouts.app')

@section('title', 'コミュニティ一覧')

@section('content')
    <section>
        <h2 class="page-tit u-mb-xl"><i class="fas fa-search u-mr-base"></i>コミュニティを探す
            <div class="u-fs-sm u-fw-normal u-mt-xs">一緒に学習するコミュニティを探してください。</div>
        </h2>
        @foreach($communities as $community)
        <a class="community-content__link" href="{{ route('community.show', ['community' => $community]) }}">
            <div class="community-content u-xs-d-flex">
                <div class="community-content__left u-xs-mr-base">
                    <div class="community-flg">募集中</div>
                </div>
                <section class="community-content__right">
                    <h3 class="community-name u-fs-lg">{{ $community->name }}</h3>
                    <div class="u-md-d-flex">
                        <div class="u-fw-bold u-mb-xs u-md-mr-base u-md-mb-no"><span class="c-tag-sm c-tag-red u-mr-sm">開始日時</span><span class="d-inline-block u-fs-sm">{{ $community->getDate($community->start) }} {{ $community->getTime($community->start) }}</span></div>
                        <div class="u-fw-bold"><span class="c-tag-sm c-tag-green u-mr-sm">終了日時</span><span class="d-inline-block u-fs-sm">{{ $community->getDate($community->end) }} {{ $community->getTime($community->end) }}</span></div>
                    </div>
                    <div class="community-row">
                        <div class="u-fs-sm">応募数<span class="community-requested__num u-fs-xl u-mx-sm">{{ $community->getTotalRecruitment() }}</span>件</div>
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
        </a>
        @endforeach
    </section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection