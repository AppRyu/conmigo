@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection