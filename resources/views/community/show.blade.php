@extends('layouts.app')

@section('title', 'コミュニティ詳細')

@section('content')
	<h2 class="comm-det__hd">{{ $community->name }}</h2>
	<table class="comm-det-tb">
		<tbody>
			<tr class="comm-det-tb__tr">
				<th class="comm-det-tb__th" scope="row">開始日時</th>
				<td class="comm-det-tb__td"><span class="comm-det-tb__td_d-inline-block">{{ $startDay }}</span><span class="comm-det-tb__td_d-inline-block">{{ $startTime }}</span></td>
			</tr>
			<tr class="comm-det-tb__tr">
				<th class="comm-det-tb__th" scope="row">終了日時</th>
				<td class="comm-det-tb__td"><span class="comm-det-tb__td_d-inline-block">{{ $endDay }}</span><span class="comm-det-tb__td_d-inline-block">{{ $endTime }}</span></td>
			</tr>
		</tbody>
	</table>
	<div class="comm-det-desc">
		<h3 class="comm-det-desc__hd"><span class="comm-det-desc__hd_emphasis">コミュニティの詳細</span></h3>
		<div class="comm-det-desc__cmt">{{ $community->detail }}</div>
	</div>
	<div class="comm-det-rct">
		<a class="comm-det-rct__btn" href="">応募する</a>
	</div>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection
