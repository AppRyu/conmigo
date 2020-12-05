@extends('layouts.app')

@section('title', 'コミュニティ詳細')

@section('content')
	<h2 class="comm-det__hd">{{ $community->name }}</h2>
	<table class="comm-det-tb">
		<tbody>
			<tr class="comm-det-tb__tr">
				<th class="comm-det-tb__th" scope="row">開始日時</th>
				<td class="comm-det-tb__td">{{ $community->start_time }}</td>
			</tr>
			<tr class="comm-det-tb__tr">
				<th class="comm-det-tb__th" scope="row">終了日時</th>
				<td class="comm-det-tb__td">{{ $community->end_time }}</td>
			</tr>
		</tbody>
	</table>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection