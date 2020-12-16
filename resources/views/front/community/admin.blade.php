@extends('layouts.app')

@section('title', 'コミュニティ管理')

@section('content')
    <section class="ca-tabs">
        <h2 class="ca-hd">企画したコミュニティ</h2>
        <div class="ca-navTabs">
            <button class="ca-navTabs__item ca-navTabs__item_active">企画した</button>
            <button class="ca-navTabs__item">応募した</button>
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
                        <div class="ca-tb__tit"><a href="">{{ $community->name }}</a></div>
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