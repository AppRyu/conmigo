@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="prof">
        <h2 class="prof-head">基本データ</h2>
        <div class="prof-content">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="prof-content__name">{{ Auth::user()->name }}</div>
            @if(Auth::user()->comment)
                <div class="prof-content__comment">{{ Auth::user()->comment }}</div>
            @else
                <div class="prof-content__comment">コメントは設定されていません。</div>
            @endif
        </div>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="prof-content__contact">
                <i class="fas fa-globe fa-lg prof-content__icon"></i>
                @if(Auth::user()->mysite)
                <a href="{{ Auth::user()->mysite }}"></a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-twitter fa-lg prof-content__icon"></i>
                @if(Auth::user()->twitter)
                <a href="{{ Auth::user()->twitter }}"></a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-instagram fa-lg prof-content__icon"></i>
                @if(Auth::user()->instagram)
                <a href="{{ Auth::user()->instagram }}"></a>
                @endif
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-facebook-f fa-lg prof-content__icon"></i>
                @if(Auth::user()->facebook)
                <a href="{{ Auth::user()->facebook }}"></a>
                @endif
            </div>
        </div>
        <div class="prof-edit">
            <a class="btn btn-primary" href="">プロフィールを編集</a>
        </div>
    </div>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection