@extends('layouts.app')

@section('title', 'コミュニティ詳細')

@section('content')
        
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection