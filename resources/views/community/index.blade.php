@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
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
            </div>
            <div class="col-md-3 d-none d-md-block">
                <!-- プロフィールサイドバー -->
                @include('./components/sidebar')
            </div>
        </div>
    </div>
@endsection
