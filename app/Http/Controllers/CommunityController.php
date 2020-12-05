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
        $community = Community::where('id', $id)->first();
        return view('community.show', ['community' => $community]);
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
