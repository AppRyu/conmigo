@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <section>
        <h2 class="page-tit u-mb-xl"><i class="fas fa-user u-mr-base"></i>プロフィール</h2>
        <section class="prof-content u-mb-lg">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="u-mb-base">{{ $user->name }}</div>
            @if($user->comment)
                <p class="prof-content__comment">{!! nl2br(e($user->comment)) !!}</p>
            @else
                <p class="prof-content__comment">コメントは設定されていません。</p>
            @endif
        </section>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="u-mb-base">
                <i class="fas fa-globe fa-lg prof-content__icon"></i>
                @if($user->mysite)
                <a href="https://{{ $user->mysite }}" target="_blank" rel="noopener noreferrer">{{ $user->mysite }}</a>
                @endif
            </div>
            <div class="u-mb-base">
                <i class="fab fa-twitter fa-lg prof-content__icon"></i>
                @if($user->twitter)
                <a href="https://twitter.com/{{ $user->twitter }}" target="_blank" rel="noopener noreferrer">{{ $user->twitter }}</a>
                @endif
            </div>
            <div class="u-mb-base">
                <i class="fab fa-instagram fa-lg prof-content__icon"></i>
                @if($user->instagram)
                <a href="https://www.instagram.com/{{ $user->instagram }}" target="_blank" rel="noopener noreferrer">{{ $user->instagram }}</a>
                @endif
            </div>
            <div class="u-mb-base">
                <i class="fab fa-facebook-f fa-lg prof-content__icon"></i>
                @if($user->facebook)
                <a href="https://www.facebook.com/{{ $user->facebook }}" target="_blank" rel="noopener noreferrer">{{ $user->facebook }}</a>
                @endif
            </div>
        </div>
        @if(Auth::check() && Auth::user()->id === $user->id)
        <div>
            <a class="btn btn-primary" href="{{ route('user.edit', ['user_name' => $user->user_name]) }}">プロフィールを編集</a>
        </div>
        @endif
    </section>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection