<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Recruit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityApplyController extends Controller
{
    public function index() {
        $appliedId = Recruit::where('applied_user', auth()->user()->id)->pluck('community_id')->toArray();
        $communities = Community::whereIn('id', $appliedId)->paginate(30);
        return view('front.community.apply.index', ['communities' => $communities]);
    }
}
