<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Recruit;
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
    public function index()
    {
        $communities = Community::orderBy('created_at', 'desc')->paginate(30);
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
        $appliedUsers = Recruit::where('community_id', $community->id)->get();
        return view('front.community.show', ['community' => $community, 'appliedUsers' => $appliedUsers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
