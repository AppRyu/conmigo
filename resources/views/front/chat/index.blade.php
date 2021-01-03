@extends('layouts.app')

@section('title', 'チャットルーム一覧')

@section('content')
    <h1>チャットルーム一覧</h1>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection