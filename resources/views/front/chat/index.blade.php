@extends('layouts.app')

@section('title', 'チャットルーム一覧')

@section('content')
    <section>
        <h2 class="page-tit u-mb-xl"><i class="fas fa-comments u-mr-base"></i>チャットルーム
            <div class="u-fs-sm u-fw-normal u-mt-xs">コミュニティのメッセージ一覧です。</div>
        </h2>
        <div class="u-mb-lg">
            @foreach ($communities as $community)
            <a href="{{ route('chat.show', ['communityWithTrashed' => $community]) }}">
                <section class="msg-sec u-p-base">
                    <h3 class="msg-sec__tit u-fs-lg u-mb-sm">{{ $community->name }}</h3>
                    <div class="u-md-d-flex">
                        <div class="u-fw-bold u-mb-xs u-md-mr-base u-md-mb-no"><span class="c-tag-sm c-tag-red u-mr-sm">開始日時</span><span class="d-inline-block u-fs-sm">{{ $community->getDate($community->start) }} {{ $community->getTime($community->start) }}</span></div>
                        <div class="u-fw-bold"><span class="c-tag-sm c-tag-green u-mr-sm">終了日時</span><span class="d-inline-block u-fs-sm">{{ $community->getDate($community->end) }} {{ $community->getTime($community->end) }}</span></div>
                    </div>
                </section>
            </a>
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