<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Recruit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommunityRequest;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::paginate(30)->sortByDesc('created_at');
        return view('front.community.index', [
            'communities' => $communities
            ]);
    }

    public function show(String $id)
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

    public function store(CommunityRequest $request, Community $community)
    {      
        $community->fill($request->all());
        $community->save();
        return redirect()->route('community.index'); 
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
