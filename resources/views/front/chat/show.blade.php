@extends('layouts.app')

@section('title', 'チャットルーム')

@section('content')
    <section class="chat-inner">
        <h2 class="chat-tit"><i class="fas fa-comments chat-tit__icon"></i>チャットルーム
            <div class="chat-tit__sub">コミュニティに関する連絡はこちらのページをご利用ください。</div>
        </h2>
        <div class="chat-container">
            <div class="chat-content">
                <div class="chat-content__img">
                    <div class="chat-content__prof-icon"><img src="{{ asset('./img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                </div>
                <section class="chat-content__box">
                    <div class="chat-content__row">
                        <h3 class="chat-content__usr-name">吉野隼翔</h3>
                        <p class="chat-content__date">2020年12月18日 23:46</p>
                    </div>
                    <p class="chat-content__msg">提案が購入されました。<br>チャットルームでやりとりを開始してください。<br>提案内容を確認するにはこちらを参照ください。</p>
                </section>
            </div>
            <div class="chat-content">
                <div class="chat-content__img">
                    <div class="chat-content__prof-icon"><img src="{{ asset('./img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                </div>
                <section class="chat-content__box">
                    <div class="chat-content__row">
                        <h3 class="chat-content__usr-name">吉野隼翔</h3>
                        <p class="chat-content__date">2020年12月18日 23:46</p>
                    </div>
                    <p class="chat-content__msg">提案が購入されました。<br>チャットルームでやりとりを開始してください。<br>提案内容を確認するにはこちらを参照ください。</p>
                </section>
            </div>
            <div class="chat-content">
                <div class="chat-content__img">
                    <div class="chat-content__prof-icon"><img src="{{ asset('./img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                </div>
                <section class="chat-content__box">
                    <div class="chat-content__row">
                        <h3 class="chat-content__usr-name">吉野隼翔</h3>
                        <p class="chat-content__date">2020年12月18日 23:46</p>
                    </div>
                    <p class="chat-content__msg">提案が購入されました。<br>チャットルームでやりとりを開始してください。<br>提案内容を確認するにはこちらを参照ください。</p>
                </section>
            </div>
            <div class="chat-content">
                <div class="chat-content__img">
                    <div class="chat-content__prof-icon"><img src="{{ asset('./img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                </div>
                <section class="chat-content__box">
                    <div class="chat-content__row">
                        <h3 class="chat-content__usr-name">吉野隼翔</h3>
                        <p class="chat-content__date">2020年12月18日 23:46</p>
                    </div>
                    <p class="chat-content__msg">提案が購入されました。<br>チャットルームでやりとりを開始してください。<br>提案内容を確認するにはこちらを参照ください。</p>
                </section>
            </div>
            <div class="chat-content">
                <div class="chat-content__img">
                    <div class="chat-content__prof-icon"><img src="{{ asset('./img/default-icon.png') }}" alt="ユーザープロフィール画像"></div>
                </div>
                <form class="chat-form" action="" method="post">
                    @csrf
                    <textarea class="chat-form__textarea" name="" placeholder="メッセージを入力する..."></textarea>
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