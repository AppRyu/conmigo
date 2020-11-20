@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <form>
        <h2 class="prof-head">基本データ</h2>
        <div class="prof-content">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">名前 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="user_name">ユーザーネーム <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="user_name" value="{{ $user->user_name }}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="comment">自己紹介</label>
                <textarea class="form-control" name="" id="comment" placeholder="自己紹介文を入力してください...">{{ ($user->comment) ? $user->comment : '' }}</textarea>
            </div>
        </div>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="form-group">
                <label for="mysite"><i class="fas fa-globe fa-lg prof-content__icon"></i> WEBサイト</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://</div>
                    </div>
                    <input type="text" class="form-control" id="mysite" value="{{ ($user->mysite) ? $user->mysite : '' }}" placeholder="example.com">
                </div>
            </div>
            <div class="form-group">
                <label for="twitter"><i class="fab fa-twitter fa-lg prof-content__icon"></i> Twitterアカウント</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://twitter.com/</div>
                    </div>
                    <input type="text" class="form-control" id="twitter" value="{{ ($user->twitter) ? $user->twitter : '' }}" placeholder="ユーザーネーム（@は省略)">
                </div>
            </div>
            <div class="form-group">
                <label for="instagram"><i class="fab fa-instagram fa-lg prof-content__icon"></i> instagramアカウント</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://www.instagram.com/</div>
                    </div>
                    <input type="text" class="form-control" id="instagram" value="{{ ($user->instagram) ? $user->instagram : '' }}" placeholder="ユーザーネーム">
                </div>
            </div>
            <div class="form-group">
                <label for="facebook"><i class="fab fa-facebook-f fa-lg prof-content__icon"></i> facebookアカウント</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://www.facebook.com/</div>
                    </div>
                    <input type="text" class="form-control" id="facebook" value="{{ ($user->facebook) ? $user->facebook : '' }}" placeholder="ユーザーネーム">
                </div>
            </div>
        </div>
        <div class="prof-btn">
            <a class="btn btn-primary" href="{{ route('user.edit', ['user_name' => $user->user_name]) }}">編集を更新する</a>
        </div>
    </form>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection