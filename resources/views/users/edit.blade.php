@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <form method="post" action="{{ route('user.update', ['user_name' => $user->user_name]) }}">
        @csrf
        @method('put')
        <h2 class="prof-head">基本データ</h2>
        <div class="prof-content">
            <h3 class="prof-content__head">プロフィール</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">名前 <span class="text-danger">*</span></label>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="名前を入力してください" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="user_name">ユーザーネーム <span class="text-danger">*</span></label>
                    @error('user_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" id="user_name" value="{{ old('user_name', $user->user_name) }}" placeholder="ユーザーネームを入力してください" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="comment">自己紹介</label>
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment" placeholder="自己紹介文を入力してください...">{{ old('comment', $user->comment) }}</textarea>
            </div>
        </div>
        <div class="prof-content">
            <h3 class="prof-content__head">連絡先情報</h3>
            <div class="form-group">
                <label for="mysite"><i class="fas fa-globe fa-lg prof-content__icon"></i> WEBサイト</label>
                @error('mysite')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://</div>
                    </div>
                    <input type="text" class="form-control" name="mysite" id="mysite" value="{{ old('mysite', $user->mysite) }}" placeholder="example.com">
                </div>
            </div>
            <div class="form-group">
                <label for="twitter"><i class="fab fa-twitter fa-lg prof-content__icon"></i> Twitterアカウント</label>
                @error('twitter')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://twitter.com/</div>
                    </div>
                    <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" id="twitter" value="{{ old('twitter', $user->twitter) }}" placeholder="ユーザーネーム（@は省略)">
                </div>
            </div>
            <div class="form-group">
                <label for="instagram"><i class="fab fa-instagram fa-lg prof-content__icon"></i> instagramアカウント</label>
                @error('instagram')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://www.instagram.com/</div>
                    </div>
                    <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" id="instagram" value="{{ old('instagram', $user->instagram) }}" placeholder="ユーザーネーム">
                </div>
            </div>
            <div class="form-group">
                <label for="facebook"><i class="fab fa-facebook-f fa-lg prof-content__icon"></i> facebookアカウント</label>
                @error('facebook')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">https://www.facebook.com/</div>
                    </div>
                    <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" id="facebook" value="{{ old('facebook', $user->facebook) }}" placeholder="ユーザーネーム">
                </div>
            </div>
        </div>
        <div class="prof-btn">
            <button class="btn btn-primary">編集を更新する</button>
        </div>
    </form>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection