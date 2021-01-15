@extends('layouts.app')

@section('title', 'チャットルーム')

@section('content')
    <section class="chat-inner">
        <h2 class="page-tit u-mb-xl"><i class="fas fa-comments u-mr-base"></i>チャットルーム
            <div class="u-fs-sm u-fw-normal u-mt-xs">コミュニティに関する連絡はこちらのページをご利用ください。</div>
        </h2>
        <div>
            @if(is_null($community->deleted_at))
            <h3 class="u-fs-xl u-mb-base"><a class="c-link-blue" href="{{ route('community.show', ['community' => $community]) }}">{{ $community->name }}</a></h3>
            @else
            <h3 class="u-fs-xl u-mb-base">{{ $community->name }}</h3>
            @endif
            @switch($communityStatus)
            @case('deleted')
                <div class="c-alert-red u-mb-base">このコミュニティは既に削除されました。</div>
            @break
            @case('noMember')
                <div class="c-alert-yellow u-mb-base">コミュニティ管理画面からメンバーを確定しよう。</div>
            @break
            @case('noMsg')
                <div class="c-alert-green u-mb-base">メンバーに挨拶メッセージを送ろう。</div>
            @break
            @default
                <div class="c-alert-gray u-mb-base">一緒に勉強する時間や方法（slack,zoom等）を話し合ってください。</div>
            @endswitch
            <div class="u-mb-lg">
                @include('./modules/timeTable', ['startDate' => $community->getDate($community->start), 'startTime' => $community->getTime($community->start), 'endDate' => $community->getDate($community->end), 'endTime' => $community->getTime($community->end)])
            </div>
        </div>
        <div class="chat-container u-px-base u-pt-base">
            @foreach($AllCommunityMember as $user)
            @continue(Auth::user()->id === $user->id)
            <div class="chat-content u-py-base">
                <div class="chat-content__img u-mr-base">
                    @if($user->profile_image)
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/storage/img/'.$user->profile_image) }}" alt="ユーザープロフィール画像"></div>
                    @else
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                    @endif
                </div>
                <section>
                    <h4 class="u-fs-lg"><a class="c-link-blue" href="{{ route('user.show', ['user_name' => $user->user_name]) }}">{{ $user->user_name }}</a></h4>
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
                        @if(Auth::user()->id === $chat->user_id)
                        <h4 class="u-fs-base u-fw-xbd">{{ $chat->userWithTrashed($chat->user_id)->user_name }}</h4>
                        @else
                        <h4 class="u-fs-base">{{ $chat->userWithTrashed($chat->user_id)->user_name }}</h4>
                        @endif
                        <p class="chat-content__date">{{ $chat->created_at }}</p>
                    </div>
                    <p class="chat-content__msg">{!! nl2br(e($chat->message)) !!}</p>
                </section>
            </div>
            @endforeach
            <div class="chat-content u-py-base">
                <div class="u-mr-base">
                    @if(Auth::user()->profile_image)
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/storage/img/'.Auth::user()->profile_image) }}" alt="ユーザープロフィール画像"></div>
                    @else
                    <div class="c-icon-md chat-icon--border"><img src="{{ asset('/img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                    @endif
                </div>
                <section class="chat-content__form-sec">
                    <h4 class="u-fs-base u-fw-xbd u-mb-sm">{{ Auth::user()->user_name }}</h4>
                    <form class="chat-form" action="{{ route('chat.sendMessage', ['community' => $community]) }}" method="post">
                        @csrf
                        <textarea class="chat-form__textarea u-mb-base" name="message" placeholder="メッセージを入力する..." required></textarea>
                        <div class="u-ta-center">
                            <button class="chat-form__btn" type="submit">送信</button>
                        </div>
                    </form>
                </section>
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