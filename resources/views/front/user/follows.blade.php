@extends('layouts.app')

@section('title', 'フォロー＆フォロワー')

@section('content')
<section>
    <h2 class="page-tit u-mb-xl"><i class="fas fa-user-friends u-mr-base"></i>フォロー管理</h2>
    <div class="nav-tab">
        <router-link class="nav-tab__item nav-tab__item_active" to="/follows/following">フォロー中</router-link>
        <router-link class="nav-tab__item" :to="{path: '/follows/follower'}">フォロワー</router-link>
    </div>
    <router-view 
                :followers="{{ Auth::user()->followers }}"
                :followings="{{ Auth::user()->followings }}"
    >
    </router-view>
</section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection