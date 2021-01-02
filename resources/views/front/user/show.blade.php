@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="prof">
        <h2 class="prof-tit"><i class="fas fa-user prof-tit__icon"></i>基本データ</h2>
        <div class="prof-content">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="prof-content__name">{{ $user->name }}</div>
            @if($user->comment)
                <p class="prof-content__comment">{!! nl2br(e($user->comment)) !!}</p>
            @else
                <p class="prof-content__comment">コメントは設定されていません。</p>
            @endif
        </div>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="prof-content__contact">
                <i class="fas fa-globe fa-lg prof-content__icon"></i>
                @if($user->mysite)
                <a href="https://{{ $user->mysite }}" target="_blank" rel="noopener noreferrer">{{ $user->mysite }}</a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-twitter fa-lg prof-content__icon"></i>
                @if($user->twitter)
                <a href="https://twitter.com/{{ $user->twitter }}" target="_blank" rel="noopener noreferrer">{{ $user->twitter }}</a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-instagram fa-lg prof-content__icon"></i>
                @if($user->instagram)
                <a href="https://www.instagram.com/{{ $user->instagram }}" target="_blank" rel="noopener noreferrer">{{ $user->instagram }}</a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-facebook-f fa-lg prof-content__icon"></i>
                @if($user->facebook)
                <a href="https://www.facebook.com/{{ $user->facebook }}" target="_blank" rel="noopener noreferrer">{{ $user->facebook }}</a>
                @endif
            </div>
        </div>
        @if(Auth::user()->id === $user->id)
        <div class="prof-btn">
            <a class="btn btn-primary" href="{{ route('user.edit', ['user_name' => $user->user_name]) }}">プロフィールを編集</a>
        </div>
        @endif
    </div>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection