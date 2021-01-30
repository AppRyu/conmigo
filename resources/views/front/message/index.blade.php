@extends('layouts.app')

@section('title', 'ダイレクトメッセージ')

@section('content')
    <section>
        <h2 class="page-tit u-mb-xl"><i class="fas fa-envelope u-mr-base"></i>メッセージ
            <div class="u-fs-sm u-fw-normal u-mt-xs">ダイレクトメッセージの一覧です。</div>
        </h2>
    </section>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection