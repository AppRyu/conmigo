@extends('layouts.app')

@section('title', 'ダイレクトメッセージ')

@section('content')
<section>
    <h2 class="page-tit u-mb-xl"><i class="fas fa-envelope u-mr-base"></i>メッセージ
        <div class="u-fs-sm u-fw-normal u-mt-xs">ダイレクトメッセージの一覧です。</div>
    </h2>
    <div>
        @foreach($rooms as $room)
        <a href="{{ route('message.show', ['user' => $room->user_without_auth_user]) }}">
            <div class="follows-content">
                <div class="u-d-flex">
                    <div class="u-mr-base">
                        <div class="c-icon-md">
                            @if($room->user_without_auth_user->profile_image)
                            <img src="{{ asset('/storage/img/'.$room->user_without_auth_user->profile_image) }}" alt="プロフィール画像">
                            @else
                            <img src="{{ asset('/img/default-icon.png') }}" alt="プロフィール画像">
                            @endif
                        </div>
                    </div>
                    <div class="u-fb-fg-1">
                        <div class="u-xs-d-flex u-d-block u-fb-jc-btw u-mb-xs">
                            <div>
                                <h3 class="u-fs-lg u-fw-bold">{{ $room->user_without_auth_user->name }}</h3>
                                <div class="u-tcd-gray"><span>@</span>{{ $room->user_without_auth_user->user_name }}</div>
                            </div>
                            <div class="u-tcd-gray u-ta-right u-sm-d-block u-d-none">最終ログイン：{{ $room->user_without_auth_user->last_login }}</div>
                        </div>
                        @if($room->most_recently_message)
                        <p class="u-fs-sm">{{ Str::limit($room->most_recently_message->body, 30, '...') }}</p>
                        @else
                        <p class="u-fs-sm">まだメッセージはありません。</p>
                        @endif
                    </div>
                </div>
            </div>
        </a>
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