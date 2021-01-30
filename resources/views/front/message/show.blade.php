@extends('layouts.app')

@section('title', 'ダイレクトメッセージ詳細')

@section('content')
    <div class="container">
        <h2 class="page-tit u-mb-xl"><i class="fas fa-envelope u-mr-base"></i>メッセージ
            <div class="u-fs-sm u-fw-normal u-mt-xs">ユーザーに対してのメッセージはこちらをご利用ください。</div>
        </h2>
        <message 
                :room-id="{{ $chat_room_id }}"
                :matching-user="{{ $matching_user }}"
                :auth-user="{{ Auth::user() }}"
        >
        </message>
    </div>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection