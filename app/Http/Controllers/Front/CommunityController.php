<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Recruit;
use App\Member;
use App\User;
use App\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Community\CommunityStoreRequest;

class CommunityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Community::class, 'community');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Community::query();
        $search = $request->input('search');
        // もし検索キーワードがあったら
        if($search !== null) {
            // 全額スペースを半角に
            $search_split = mb_convert_kana($search,'s');
            // 空欄で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);
            // 単語をループで回す
            foreach($search_split2 as $value)
            {
            $query->where('name','like','%'.$value.'%');
            }
        }
        $query->orderBy('created_at', 'desc');
        $communities = $query->paginate(30);

        return view('front.community.index', ['communities' => $communities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.community.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityStoreRequest $request, Community $community)
    {
        $community->fill($request->all());
        $community->created_user = auth()->user()->id;
        $community->save();
        return redirect()->route('community.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        // 応募しているユーザーIDすべて取得
        $appliedUsersId = Recruit::where('community_id', $community->id)->pluck('applied_user')->toArray();
        // 当選しているユーザーIDをすべて取得
        $winningUsersId = Member::where('community_id', $community->id)->whereIn('user_id', $appliedUsersId)->pluck('user_id')->toArray();
        // 応募しているユーザーすべて取得
        $appliedUsers = Recruit::where('community_id', $community->id)->get();
        // 当選しているユーザーすべて取得
        $winningUsers = Member::where('community_id', $community->id)->whereIn('user_id', $appliedUsersId)->get();
        // 落選しているユーザーすべて取得
        $losingUsers = Recruit::where('community_id', $community->id)->whereNotIn('applied_user', $winningUsersId)->get();

        return view('front.community.show', [
            'community' => $community, 
            'appliedUsers' => $appliedUsers, 
            'winningUsers' => $winningUsers, 
            'losingUsers' => $losingUsers
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        return view('front.community.edit', ['community' => $community]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommunityStoreRequest $request, Community $community)
    {   
        $community->fill($request->all())->save();
        return redirect()->route('community.plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        $community->delete();
        return redirect(route('community.plan.index', ['user_name' => auth()->user()->user_name]))->with('error', '削除処理に成功しました');
    }

    public function apply(Request $request)
    {
        Recruit::create([
            'community_id' => $request->id,
            'applied_user' => $request->user()->id,
        ]);
        return response("OK", 200);
    }

    public function like(Request $request, Community $community)
    {
        Like::where(['user_id' => $request->user()->id, 'community_id' => $community->id])->delete();
        Like::create(['user_id' => $request->user()->id, 'community_id' => $community->id]);
        return;
    }

    public function unlike(Request $request, Community $community)
    {
        Like::where(['user_id' => $request->user()->id, 'community_id' => $community->id])->delete();
        return;
    }

    public function likes(Request $request) {
        // likesテーブルでuser_id(ログインID)からcommunity_idを取得
        $likedCommunityId = Like::where('user_id', $request->user()->id)->pluck('community_id')->toArray();
        // 上記で取得したcommunity_idから対応するコミュニティデータを取得
        $communities = Community::whereIn('id', $likedCommunityId)->orderBy('created_at', 'desc')->paginate(30);
        return view('front.community.likes', ['communities' => $communities]);
    }
}
