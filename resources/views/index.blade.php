@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-6 col-12">
            <h1 class="main-tit u-py-base u-md-py-lg">仲間と一緒に<br>学習を<span class="u-fc-blue">習慣化</span></h1>
            <p class="u-fs-lg">プログラミング・Webデザイン学習者を対象とし、学習を継続し習慣化するためのプラットフォームを提供します</p>
            <hr class="my-4">
            @guest
            <a class="main-btn u-mb-base" href="{{ route('register') }}" role="button"><span class="main-btn__txt">新規登録</span></a>
            <a class="main-btn--outline u-mb-base" href="{{ route('login') }}" role="button"><span class="main-btn--outline__txt">ログイン</span></a>
            @else
            <a class="main-btn u-mb-base" href="{{ route('community.index') }}" role="button"><span class="main-btn__txt">学習コミュニティを探す</span></a>
            <a class="main-btn--outline u-mb-base" href="{{ route('community.create') }}" role="button"><span class="main-btn--outline__txt">学習コミュニティを作成</span></a>
            @endguest
        </div>
        <div class="col-md-6 col-12 u-d-flex align-items-center">
            <img src="./img/hero.svg" alt="">
        </div>
    </div>
</div>
@endsection
