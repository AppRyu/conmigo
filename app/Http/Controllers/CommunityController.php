<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;
use App\Http\Requests\CommunityRequest;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::paginate(30);
        return view('community.index', ['communities' => $communities]);
    }

    public function show(String $id)
    {
        $communities = new Community;
        $community = $communities->where('id', $id)->first();
        $startDay = $community->getDate($community->start_time);
        $startTime = $community->getTime($community->start_time);
        $endDay = $community->getDate($community->end_time);
        $endTime = $community->getTime($community->end_time);
        return view('community.show', [
            'community' => $community,
            'startDay' => $startDay,
            'startTime' =>  $startTime,
            'endDay' => $endDay,
            'endTime' => $endTime
            ]);
    }

    public function create()
    {
        return view('community.create');
    }

    public function store(CommunityRequest $request, Community $community)
    {      
        $community->fill($request->all());
        $community->save();
        return redirect()->route('community.index'); 
    }
}
