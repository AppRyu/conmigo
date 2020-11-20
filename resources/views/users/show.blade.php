@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="prof">
        <h2 class="prof-head">基本データ</h2>
        <div class="prof-content">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="prof-content__name">{{ $user->name }}</div>
            @if($user->comment)
                <div class="prof-content__comment">{{ $user->comment }}</div>
            @else
                <div class="prof-content__comment">コメントは設定されていません。</div>
            @endif
        </div>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="prof-content__contact">
                <i class="fas fa-globe fa-lg prof-content__icon"></i>
                @if($user->mysite)
                <a href="{{ $user->mysite }}"></a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-twitter fa-lg prof-content__icon"></i>
                @if($user->twitter)
                <a href="{{ $user->twitter }}"></a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-instagram fa-lg prof-content__icon"></i>
                @if($user->instagram)
                <a href="{{ $user->instagram }}"></a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-facebook-f fa-lg prof-content__icon"></i>
                @if($user->facebook)
                <a href="{{ $user->facebook }}"></a>
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