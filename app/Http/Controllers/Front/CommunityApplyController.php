<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Recruit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityApplyController extends Controller
{
    public function index() {
        $appliedId = Recruit::where('applied_user', auth()->user()->id)->get('community_id')->toArray();
        $appliedCommunities = Community::withTrashed()->whereIn('id', $appliedId)->paginate(15);
        return view('front.community.apply.index', ['appliedCommunities' => $appliedCommunities]);
    }
}
