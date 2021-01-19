@extends('layouts.app')

@section('title', 'ログイン')

@section('content')

<div class="auth-container">
    <h1 class="auth-hd">Sign in</h1>
    <form class="auth-form" method="post" action="{{ route('login') }}">
		@csrf
		<div class="auth-form__group">
			<label for="email" class="auth-form__label">メールアドレス</label>
			@error('email')
				<p class="auth-form__invalid" role="alert">
					<strong>{{ $message }}</strong>
				</p>
			@enderror
			<input id="email" type="email" class="auth-form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
		</div>
		<div class="auth-form__group">
			<label for="password" class="auth-form__label">パスワード</label>
			@error('password')
				<p class="auth-form__invalid" role="alert">
					<strong>{{ $message }}</strong>
				</p>
			@enderror
			<input id="password" type="password" class="auth-form__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
		</div>
		<div class="auth-form__group auth-form__group_btn">
			<button type="submit" class="auth-form__btn">Sign in</button>
		</div>
		<div class="auth-form__group auth-form__group_checkbox">
			<input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
			<label for="remember" class="auth-form__label auth-form__label_checkbox">ログイン状態を保持</label>
		</div>
		@if (Route::has('password.request'))
		<div class="auth-link">
			<a class="auth-link__forgot" href="{{ route('password.request') }}">パスワードをお忘れの方はこちらへ</a>
		</div>
		@endif
    </form>       
</div>

@endsection