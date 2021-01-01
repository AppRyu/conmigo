@extends('layouts.app')

@section('title', 'チャットルーム')

@section('content')
    <h1>チャットページです</h1>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection