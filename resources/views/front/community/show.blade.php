@extends('layouts.app')

@section('title', 'コミュニティ詳細')

@section('content')
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
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection