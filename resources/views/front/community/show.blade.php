@extends('layouts.app')

@section('title', 'コミュニティ詳細')

@section('content')
<section>
	<h2 class="page-tit u-mb-xl"><i class="fas fa-search-plus u-mr-base"></i>コミュニティ詳細
		<div class="u-fs-sm u-fw-normal u-mt-xs">コミュニティの内容を確認してください。</div>
	</h2>
	<h3 class="u-fs-xl u-xs-fs-xl u-mb-base">{{ $community->name }}</h3>
	<div class="u-mb-lg">
		@include('./modules/timeTable', ['startDate' => $community->getDate($community->start), 'startTime' => $community->getTime($community->start), 'endDate' => $community->getDate($community->end), 'endTime' => $community->getTime($community->end)])
	</div>
	<section class="comm-det-desc u-mb-lg">
		<h4 class="comm-det-desc__hd u-mb-base"><span class="comm-det-desc__hd_emphasis">コミュニティの詳細</span></h4>
		<div class="comm-det-desc__cmt">{!! nl2br(e($community->detail)) !!}</div>
	</section>
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
		<h4 class="created-user__hd u-mb-base"><span class="created-user__hd_emphasis">クリエイトユーザー情報</span></h4>
		<a class="created-use-card__link" href="{{ route('user.show', ['user_name' => $community->users->user_name]) }}">
			<div class="created-user-card">
				<div class="u-xs-d-flex">
					<div class="created-user-card__img c-icon-lg u-mr-sm">
						@if($community->users->profile_image)
						<img src="{{ asset('/storage/img/'.$community->users->profile_image) }}" alt="企画したユーザープロフィール画像">
						@else
						<img src="{{ asset('./img/default-icon.png') }}" alt="企画したユーザープロフィール画像">
						@endif
					</div>
					<section>
						<h4 class="u-fs-lg u-fw-bold">{{ $community->users->name }}</h4>
						<p class="u-ta-justify">{!! nl2br(e($community->users->comment)) !!}</p>
					</section>
				</div>
			</div>
		</a>
	</section>
	<section>
		<h4 class="u-fs-lg u-mb-base">現在の応募<span class="u-fs-xl u-fw-bold u-mx-sm u-c---dark-blue">{{ $appliedUsers->count() }}</span>件</h4>
		<table class="applied-user-tb">
			<thead class="applied-user-tb__hd">
				<tr class="applied-user-tb__tr">
					<th scope="col" class="applied-user-tb__thc">応募ユーザー</th>
					<th scope="col" class="applied-user-tb__thc u-d-none u-xs-d-table-cell">応募日時</th>
				</tr>
			</thead>
			<tbody class="applied-user-tb__bd">
				@foreach($appliedUsers as $appliedUser)
				<tr class="applied-user-tb__tr">
					<td class="applied-user-tb__td">
						<a class="u-d-block" href="{{ route('user.show', ['user_name' => $appliedUser->users->user_name]) }}">
							@if($appliedUser->users->profile_image)
							<img class="applied-user-tb__img" src="{{ asset('/storage/img/'.$appliedUser->users->profile_image) }}" alt="応募したユーザーのプロフィール画像">
							@else
							<img class="applied-user-tb__img" src="{{ asset('./img/default-icon.png') }}" alt="応募したユーザーのプロフィール画像">
							@endif
							<span class="c-link-blue">{{ $appliedUser->users->user_name }}</span>
						</a>
					</td>
					<td class="applied-user-tb__td u-d-none u-xs-d-table-cell">{{ $appliedUser->created_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
</section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection