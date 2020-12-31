@extends('layouts.app')

@section('title', '企画したコミュニティ詳細')

@section('content')
    <section class="select-user">
        <h2 class="select-user__hd">{{ $community->name }}</h2>
        <p>学習する仲間を<span>1人</span>選択してください。</p>
        <form action="{{ route('community.plan.determineUser', ['community' => $community]) }}" method="post">
            @csrf
            <community-select-user :applied-users={{ $appliedUsers }}
                                    :max-users-number=1></community-select-user>
        </form>
    </section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection