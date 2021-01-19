@extends('layouts.app')

@section('title', '各種設定')

@section('content')
    <div class="d-flex flex-md-row flex-column">
        <aside class="col-md-4 col-lg-3 col-12 u-md-mb-no u-mb-xl">
            <div class="settings-sidebar">
                <div class="settings-prof">
                    @if(Auth::user()->profile_image !== null)
                    <div class="settings-prof__img c-icon-sm u-mr-sm"><img src="{{ asset('/storage/img/'.Auth::user()->profile_image) }}" alt="ログインユーザーのプロフィール画像"></div>
                    @else
                    <div class="settings-prof__img c-icon-sm u-mr-sm"><img src="{{ asset('./img/default-icon.png') }}" alt="ログインユーザーのプロフィール画像"></div>
                    @endif
                    <div class="u-fs-base u-fw-bold">{{ Auth::user()->name }}</div>
                </div>
                <ul class="settings-menu">
                    <li class="settings-item"><router-link class="settings-item__link" to="/setting/profile">プロフィール</router-link></li>
                    <li class="settings-item"><router-link class="settings-item__link" :to="{path: '/setting/account'}">アカウント</router-link></li>
                </ul>
            </div>
        </aside>
        <article class="col-md-8 col-lg-9 col-12">
            <router-view 
                        account-delete-url="{{ route('user.destroy', ['user' => Auth::user()]) }}"
                        redirect-login="{{ route('login') }}"
                        redirect-logout="{{ route('logout') }}"
                        post-to-user-update="{{ route('user.update', ['user_name' => Auth::user()->user_name]) }}"
                        :user-data="{{ Auth::user() }}"
                        user-profile-image-path="{{ Auth::user()->profile_image ? asset('/storage/img/'.Auth::user()->profile_image) : asset('./img/default-icon.png') }}"
                        :csrf="{{ json_encode(csrf_token()) }}"
                        >
            </router-view>
        </article>
    </div>
@endsection