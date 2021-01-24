@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
<section>
    <h2 class="page-tit u-mb-xl"><i class="fas fa-user u-mr-base"></i>プロフィール</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-4 u-xs-d-block u-d-none">
                <div class="u-mb-sm user-prof__img">
                    @if($user->profile_image)
                    <img src="{{ asset('/storage/img/'.$user->profile_image) }}" alt="プロフィール画像">
                    @else
                    <img src="{{ asset('./img/default-icon.png') }}" alt="プロフィール画像">
                    @endif
                </div>

                @if($user->mysite)
                <a href="https://{{ $user->mysite }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn user-prof__btn--web u-mb-sm"><i class="fas fa-link u-mr-xs"></i>Web Site</a>
                @else
                <button class="user-prof__btn-outline user-prof__btn-outline--web u-mb-sm"><i class="fas fa-link u-mr-xs"></i>Web Site</button>
                @endif

                @if($user->twitter)
                <a href="https://twitter.com/{{ $user->twitter }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn user-prof__btn--twitter u-mb-sm"><i class="fab fa-twitter u-mr-xs"></i>twitter</a>
                @else
                <button class="user-prof__btn-outline user-prof__btn-outline--twitter u-mb-sm"><i class="fab fa-twitter u-mr-xs"></i>twitter</button>
                @endif

                @if($user->instagram)
                <a href="https://www.instagram.com/{{ $user->instagram }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn user-prof__btn--instagram u-mb-sm"><i class="fab fa-instagram u-mr-xs"></i>instagram</a>
                @else
                <button class="user-prof__btn-outline user-prof__btn-outline--instagram u-mb-sm"><i class="fab fa-instagram u-mr-xs"></i>instagram</button>
                @endif

                @if($user->facebook)
                <a href="https://www.facebook.com/{{ $user->facebook }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn user-prof__btn--facebook u-mb-sm"><i class="fab fa-facebook u-mr-xs"></i>facebook</a>
                @else
                <button class="user-prof__btn-outline user-prof__btn-outline--facebook u-mb-sm"><i class="fab fa-facebook u-mr-xs"></i>facebook</button>
                @endif

            </div>
            <div class="col-lg-9 col-sm-8 col-12">
                <div class="u-d-flex align-items-center justify-content-between u-mb-xs">
                    <div>
                        <h3 class="u-fs-xl u-fw-bold">{{ $user->name }}</h3>
                        <div class="u-fs-sm u-fw-normal"><span>@</span>{{ $user->user_name }}</div>
                    </div>
                    @if(Auth::id() !== $user->id)
                    <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                                    :authorized='@json(Auth::check())'
                                    endpoint="{{ route('users.follow', ['user_name' => $user->user_name]) }}"
                    >
                    </follow-button>
                    @endif
                </div>
                <div class="u-mb-lg">
                    <a class="u-mr-sm" href=""><span class="u-mx-xs">{{ $user->count_followings }}</span>フォロー</a>
                    <a href=""><span class="u-mx-xs">{{ $user->count_followers }}</span>フォロワー</a>
                </div>
                <div class="user-prof__img user-prof__img--sp u-xs-d-none u-d-block">
                    @if($user->profile_image)
                    <img src="{{ asset('/storage/img/'.$user->profile_image) }}" alt="プロフィール画像">
                    @else
                    <img src="{{ asset('./img/default-icon.png') }}" alt="プロフィール画像">
                    @endif
                </div>
                <section class="u-mb-lg">
                    <h4 class="u-fs-lg u-fw-bold u-mb-sm">自己紹介</h4>
                    <div class="user-prof__comment">{!! nl2br(e($user->comment)) !!}</div>
                </section>
                <div class="user-prof__btn-row">

                    @if($user->mysite)
                    <a href="{{ $user->mysite }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn--sp user-prof__btn--web"><i class="fas fa-link user-prof__btn-icon"></i></a>
                    @else
                    <button class="user-prof__btn-outline--sp user-prof__btn-outline--web"><i class="fas fa-link user-prof__btn-icon"></i></button>
                    @endif

                    @if($user->twitter)
                    <a href="https://twitter.com/{{ $user->twitter }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn--sp user-prof__btn--twitter"><i class="fab fa-twitter user-prof__btn-icon"></i></a>
                    @else
                    <button class="user-prof__btn-outline--sp user-prof__btn-outline--twitter"><i class="fab fa-twitter user-prof__btn-icon"></i></button>
                    @endif

                    @if($user->instagram)
                    <a href="https://www.instagram.com/{{ $user->instagram }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn--sp user-prof__btn--instagram"><i class="fab fa-instagram user-prof__btn-icon"></i></a>
                    @else
                    <button class="user-prof__btn-outline--sp user-prof__btn-outline--instagram"><i class="fab fa-instagram user-prof__btn-icon"></i></button>
                    @endif

                    @if($user->facebook)
                    <a href="https://www.facebook.com/{{ $user->facebook }}" target="_blank" rel="noopener noreferrer" class="user-prof__btn--sp user-prof__btn--facebook"><i class="fab fa-facebook user-prof__btn-icon"></i></a>
                    @else
                    <button class="user-prof__btn-outline--sp user-prof__btn-outline--facebook"><i class="fab fa-facebook user-prof__btn-icon"></i></button>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection