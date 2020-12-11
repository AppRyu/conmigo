@extends('layouts.app')

@section('title', 'コミュニティ管理')

@section('content')
    
    <community-admin-tabs></community-admin-tabs>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection