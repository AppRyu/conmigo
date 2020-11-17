@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                メイン
            </div>
            <div class="col-md-2 sidebar">
                <div class="container">
                    <div class="profile-img">
                        <img src="./img/default-icon.png" alt="">
                    </div>
                    <div class="profile-name">
                        <div class="profile-name__user">
                            <a href="">Hayato</a>
                        </div>
                        <div class="profile-name__id">@hayato_0227</div>
                    </div>
                    <div class="profile-data">
                        <div class="profile-intro">
                            <a class="profile-data__link" href="">基本データ</a>
                        </div>
                        <div class="profile-community">
                            <a class="profile-data__link" href="">コミュニティ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
