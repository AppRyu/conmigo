@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="prof">
        <h2 class="prof-head">基本データ</h2>
        <div class="prof-content">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="prof-content__name">名前が入ります</div>
            <div class="prof-content__comment">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</div>
        </div>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="prof-content__contact">
                <i class="fas fa-globe fa-lg prof-content__icon"></i>
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-twitter fa-lg prof-content__icon"></i>
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-instagram fa-lg prof-content__icon"></i>
            </div>
            <div class="prof-content__contact">
                <i class="fab fa-facebook-f fa-lg prof-content__icon"></i>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection