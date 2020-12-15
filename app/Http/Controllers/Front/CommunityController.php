<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Recruit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Community\CommunityStoreRequest;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::paginate(30)->sortByDesc('created_at');
        return view('front.community.index', [
            'communities' => $communities
            ]);
    }

    public function show(Int $id)
    {
        $communities = new Community;
        $community = $communities->where('id', $id)->first();
        $startDay = $community->getDate($community->start);
        $startTime = $community->getTime($community->start);
        $endDay = $community->getDate($community->end);
        $endTime = $community->getTime($community->end);
        return view('front.community.show', [
            'community' => $community,
            'startDay' => $startDay,
            'startTime' =>  $startTime,
            'endDay' => $endDay,
            'endTime' => $endTime
            ]);
    }

    public function create()
    {
        return view('front.community.create');
    }

    public function store(CommunityStoreRequest $request, Community $community)
    {      
        $community->fill($request->all());
        $community->created_user = auth()->user()->id;
        $community->save();
        return redirect()->route('community.index'); 
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Int $id)
    {
        $community = Community::find($id);
        // コミュニティ作成者がログインユーザー以外の場合
        if(auth()->user()->id != $community->created_user) {
            return redirect(route('community.admin', ['user_name' => auth()->user()->user_name]))->with('error', '許可されていない操作です');
        }
        $community->delete();
        return redirect(route('community.admin', ['user_name' => auth()->user()->user_name]))->with('error', '削除処理に成功しました');
    }

    public function apply(Request $request)
    {
        Recruit::create([
            'community_id' => $request->id,
            'applied_user' => $request->user()->id,
        ]);
        return response("OK", 200);
    }
}
