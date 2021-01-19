@extends('layouts.app')

@section('title', '新規登録')

@section('content')

<div class="auth-container">
    <h1 class="auth-hd">Register</h1>
    <form class="auth-form" method="post" action="{{ route('register') }}">
		@csrf
		<div class="auth-form__group">
			<label for="name" class="auth-form__label">名前</label>
			@error('name')
				<span class="auth-form__invalid" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
			<input id="name" type="text" class="auth-form__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
		</div>
		<div class="auth-form__group">
			<label for="user_name" class="auth-form__label">ユーザー名</label>
			@error('user_name')
				<span class="auth-form__invalid" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
			<input id="user_name" type="text" class="auth-form__input @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required>
		</div>
		<div class="auth-form__group">
			<label for="email" class="auth-form__label">メールアドレス</label>
			@error('email')
				<span class="auth-form__invalid" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
			<input id="email" type="email" class="auth-form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
		</div>
		<div class="auth-form__group">
			<label for="password" class="auth-form__label">パスワード</label>
			@error('password')
				<span class="auth-form__invalid" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
			<input id="password" type="password" class="auth-form__input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
		</div>
		<div class="auth-form__group">
			<label for="password-confirm" class="auth-form__label">パスワード（確認用）</label>
			<input id="password-confirm" type="password" class="auth-form__input" name="password_confirmation" required autocomplete="new-password">
		</div>
		<div class="auth-form__group auth-form__group_btn">
			<button type="submit" class="auth-form__btn">Register</button>
		</div>
    </form>       
</div>

@endsection