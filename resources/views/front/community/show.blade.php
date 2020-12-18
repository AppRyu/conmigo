@extends('layouts.app')

@section('title', 'コミュニティ詳細')

@section('content')
	<section class="comm-det">
		<h2 class="comm-det__hd">{{ $community->name }}</h2>
		<table class="comm-det-tb">
			<tbody>
				<tr class="comm-det-tb__tr">
					<th class="comm-det-tb__th" scope="row">開始日時</th>
					<td class="comm-det-tb__td"><span class="comm-det-tb__td_d-inline-block">{{ $community->getDate($community->start) }}</span><span class="comm-det-tb__td_d-inline-block">{{ $community->getTime($community->start) }}</span></td>
				</tr>
				<tr class="comm-det-tb__tr">
					<th class="comm-det-tb__th" scope="row">終了日時</th>
					<td class="comm-det-tb__td"><span class="comm-det-tb__td_d-inline-block">{{ $community->getDate($community->end) }}</span><span class="comm-det-tb__td_d-inline-block">{{ $community->getTime($community->end) }}</span></td>
				</tr>
			</tbody>
		</table>
		<div class="comm-det-desc">
			<h3 class="comm-det-desc__hd"><span class="comm-det-desc__hd_emphasis">コミュニティの詳細</span></h3>
			<div class="comm-det-desc__cmt">{!! nl2br(e($community->detail)) !!}</div>
		</div>
		{{-- ログインユーザー以外が企画したコミュニティのみ応募ボタンを表示 --}}
		@if(Auth::id() !== $community->created_user)
		<community-recruit-btn
			:initial-is-applied-by='@json($community->isAppliedBy(Auth::user()))'
			:authorized='@json(Auth::check())'
			endpoint="{{ route('community.apply', ['id' => $community->id]) }}"
		>
		</community-recruit-btn>
		@endif
		<section class="created-user">
			<h3 class="created-user__hd"><span class="created-user__hd_emphasis">クリエイトユーザー情報</span></h3>
			<div class="created-user-card">
				<div class="created-user-card__row">
					<div class="created-user-card__img">
						@if($community->users->profile_image)
						<img src="{{ asset('/storage/img/'.$community->users->profile_image) }}" alt="企画したユーザープロフィール画像">
						@else
						<img src="{{ asset('./img/default-icon.png') }}" alt="企画したユーザープロフィール画像">
						@endif
					</div>
					<section class="created-user-card__intro">
						<h4 class="created-user-card__name">{{ $community->users->name }}</h4>
						<p class="created-user-card__cmt">{{ $community->users->comment }}</p>
					</section>
				</div>
			</div>
		</section>
		<h2 class="comm-det__hd">現在の応募<span class="comm-det__hd_emphasis">{{ $appliedUsers->count() }}件</span></h2>
		<table class="applied-user-tb">
			<thead class="applied-user-tb__hd">
				<tr class="applied-user-tb__tr">
					<th scope="col" class="applied-user-tb__thc">応募ユーザー</th>
					<th scope="col" class="applied-user-tb__thc">応募日時</th>
				</tr>
			</thead>
			<tbody class="applied-user-tb__bd">
				@foreach($appliedUsers as $appliedUser)
				<tr class="applied-user-tb__tr">
					<td class="applied-user-tb__td">
						@if($appliedUser->users->profile_image)
						<img class="applied-user-tb__img" src="{{ asset('/storage/img/'.$appliedUser->users->profile_image) }}" alt="応募したユーザーのプロフィール画像">
						@else
						<img class="applied-user-tb__img" src="{{ asset('./img/default-icon.png') }}" alt="応募したユーザーのプロフィール画像">
						@endif
						{{ $appliedUser->users->user_name }}</td>
					<td class="applied-user-tb__td">{{ $appliedUser->created_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection