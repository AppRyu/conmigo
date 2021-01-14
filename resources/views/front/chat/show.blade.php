@extends('layouts.app')

@section('title', 'チャットルーム')

@section('content')
    <section class="chat-inner">
        <h2 class="page-tit u-mb-xl"><i class="fas fa-comments u-mr-base"></i>チャットルーム
            <div class="u-fs-sm u-fw-normal u-mt-xs">コミュニティに関する連絡はこちらのページをご利用ください。</div>
        </h2>
        @switch($communityStatus)
            @case('deleted')
                <p class="c-alert-red u-mb-base">コミュニティは既に削除されています。</p>
                @break
            @case('noMsg')
                <p class="c-alert-green u-mb-base">メンバーに挨拶メッセージを送ろう。</p>
                @break
        @endswitch
        <div class="chat-container u-px-base u-pt-base">
            @foreach($usersWithoutCreatedUser as $user)
            <div class="chat-content u-py-base">
                <div class="chat-content__img u-mr-base">
                    @if($user->profile_image)
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/storage/img/'.$user->profile_image) }}" alt="ユーザープロフィール画像"></div>
                    @else
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                    @endif
                </div>
                <section>
                    <h3 class="u-fs-lg"><a href="{{ route('user.show', ['user_name' => $user->user_name]) }}">{{ $user->user_name }}</a></h3>
                    <!--  TODO 最終ログイン時間を表示させる 下記例 -->
                    <!-- <p>最終ログイン：2日前</p> -->
                </section>
            </div>
            @endforeach
            @foreach($chats as $chat)
            <div class="chat-content u-py-base">
                <div class="chat-content__img u-mr-base">
                    @if($chat->userWithTrashed($chat->user_id)->profile_image)
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/storage/img/'.$chat->userWithTrashed($chat->user_id)->profile_image) }}" alt="ユーザープロフィール画像"></div>
                    @else 
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                    @endif
                </div>
                <section class="chat-content__box">
                    <div class="chat-content__row u-mb-sm">
                        <h3 class="u-fs-base">{{ $chat->userWithTrashed($chat->user_id)->user_name }}</h3>
                        <p class="chat-content__date">{{ $chat->created_at }}</p>
                    </div>
                    <p class="chat-content__msg">{!! nl2br(e($chat->message)) !!}</p>
                </section>
            </div>
            @endforeach
            <div class="chat-content u-py-base">
                <div class="chat-content__img u-mr-base">
                    @if(Auth::user()->profile_image)
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/storage/img/'.Auth::user()->profile_image) }}" alt="ユーザープロフィール画像"></div>
                    @else
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                    @endif
                </div>
                <form class="chat-form" action="{{ route('chat.sendMessage', ['community' => $community]) }}" method="post">
                    @csrf
                    <textarea class="chat-form__textarea u-mb-base" name="message" placeholder="メッセージを入力する..."></textarea>
                    <div class="chat-form__btn_outer">
                        <button class="chat-form__btn" type="submit">送信</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection