@extends('layouts.app')

@section('title', '各種設定')

@section('content')
    <div class="d-flex flex-md-row flex-column">
        <aside class="col-md-4 col-lg-3 col-12">
            <div class="settings-sidebar">
                <div class="settings-prof">
                    @if(Auth::user()->profile_image !== null)
                    <div class="settings-prof__img c-icon-sm u-mr-sm"><img src="{{ asset('/storage/img/'.Auth::user()->profile_image) }}" alt="ログインユーザーのプロフィール画像"></div>
                    @else
                    <div class="settings-prof__img c-icon-sm u-mr-sm"><img src="{{ asset('./img/default-icon.png') }}" alt="ログインユーザーのプロフィール画像"></div>
                    @endif
                    <div class="u-fs-base u-fw-bold">{{ Auth::user()->user_name }}</div>
                </div>
                <ul class="settings-menu">
                    <li class="settings-item"><router-link class="settings-item__link" to="/setting/profile">プロフィール</router-link></li>
                    <li class="settings-item"><router-link class="settings-item__link" :to="{path: '/setting/account'}">アカウント</router-link></li>
                </ul>
            </div>
        </aside>
        <article class="col-md-8 col-lg-9 col-12">
            <router-view user-id="{{ Auth::user()->id }}"
                            redirect-login="{{ route('login') }}"
                            redirect-logout="{{ route('logout') }}"></router-view>
        </article>
    </div>
@endsection