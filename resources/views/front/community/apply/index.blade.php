@extends('layouts.app')

@section('title', '応募したコミュニティ一覧')

@section('content')
<section class="ca-tabs">
        <h2 class="ca-hd">応募したコミュニティ</h2>
        <div class="ca-navTabs">
            <a class="ca-navTabs__item" href="{{ route('community.plan.index') }}">企画した</a>
            <a class="ca-navTabs__item ca-navTabs__item_active" href="{{ route('community.applied') }}">応募した</a>
        </div>
        <table class="ca-tb">
            <thead class="ca-tb__hd">
                <tr class="ca-tb__tr">
                    <th scope="col" class="ca-tb__thc">title</th>
                    <th scope="col" class="ca-tb__thc">total</th>
                    <th scope="col" class="ca-tb__thc">status</th>
                    <th scope="col" class="ca-tb__thc">message</th>
                </tr>
            </thead>
            <tbody class="ca-tb__bd">
            @foreach($appliedCommunities as $community)
                <tr class="ca-tb__tr">
                    <td class="ca-tb__td">
                        <div class="ca-tb__tit"><a href="{{ route('community.show', ['community' => $community]) }}">{{ $community->name }}</a></div>
                    </td>
                    <td class="ca-tb__td">{{ $community->getTotalRecruitment() }}件</td>
                    <td class="ca-tb__td">{{ $community->isPast($community->start) ? '締切' : '募集' }}</td>
                    <td class="ca-tb__td">
                        {{-- 削除ボタン --}}
                        @if(!Auth::guest() && Auth::user()->id == $community->created_user)
                        <form action="{{ route('community.destroy', ['community' => $community]) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除" class="ca-tb__btn" onclick="return confirm('削除しますか？')">
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
    
@section('sidebar')
    @auth
        <!-- プロフィールサイドバー -->
        @include('./components/sidebar')
    @endauth
@endsection