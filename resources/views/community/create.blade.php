@extends('layouts.app')

@section('title', 'コミュニティ作成')

@section('content')

@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection