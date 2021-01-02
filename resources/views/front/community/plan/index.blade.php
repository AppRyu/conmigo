@extends('layouts.app')

@section('title', '企画したコミュニティ一覧')

@section('content')
    <section class="ca-tabs">
        <h2 class="ca-tit">企画したコミュニティ</h2>
        <div class="ca-navTabs">
            <a class="ca-navTabs__item ca-navTabs__item_active" href="{{ route('community.plan.index', ['user_name' => Auth::user()->user_name]) }}">企画した</a>
            <a class="ca-navTabs__item" href="{{ route('community.applied') }}">応募した</a>
        </div>
        <table class="ca-tb">
            <thead class="ca-tb__hd">
                <tr class="ca-tb__tr">
                    <th scope="col" class="ca-tb__thc">タイトル</th>
                    <th scope="col" class="ca-tb__thc">応募数</th>
                    <th scope="col" class="ca-tb__thc">ステータス</th>
                    <th scope="col" class="ca-tb__thc">更新</th>
                </tr>
            </thead>
            <tbody class="ca-tb__bd">
                @foreach($communities as $community)
                <tr class="ca-tb__tr">
                    <td class="ca-tb__td">
                        <div class="ca-tb__tit"><a href="{{ route('community.plan.show', ['community' => $community]) }}">{{ $community->name }}</a></div>
                    </td>
                    <td class="ca-tb__td">{{ $community->getTotalRecruitment() }}件</td>
                    <td class="ca-tb__td">{{ $community->isPast($community->start) ? '締切' : '募集中' }}</td>
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