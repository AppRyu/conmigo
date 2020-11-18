@extends('layouts.app')

@section('title', 'コミュニティ一覧')

@section('content')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">駆け出しエンジニアでもくもく会</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">もっと詳しく見る</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">初心者歓迎もくもく会</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">もっと詳しく見る</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">エンジニア・デザイナーでもくもく会</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">もっと詳しく見る</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">PHP学習者ともくもく会</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">もっと詳しく見る</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">JavaScript学習者ともくもく会</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">もっと詳しく見る</a>
            </div>
        </div>
@endsection
    
@section('sidebar')
        @auth
            <!-- プロフィールサイドバー -->
            @include('./components/sidebar')
        @endauth
@endsection