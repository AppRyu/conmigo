<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Community;
use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityPlanedController extends Controller
{
    public function index(Request $request) {
        $communities = Community::where('created_user', $request->user()->id)->orderBy('created_at', 'desc')->paginate(30);
        return view('front.community.plan.index', ['communities' => $communities]);
    }

    public function show(Community $community) {
        $appliedUserId = $community->recruits->pluck('applied_user');
        $appliedUsers = $community->users->whereIn('id', $appliedUserId)->select('id', 'user_name', 'profile_image')->get();
        return view('front.community.plan.show', ['community' => $community, 'appliedUsers' => $appliedUsers]);
    }

    public function determineUser(Request $request, Community $community) {
        $users = $request->input('users');
        for($i = 0; $i < count($users); $i++) {
            $existUser = Member::where(['user_id' => $users[$i], 'community_id' => $community->id])->count();
            if(!$existUser) {
                $member = new Member();
                $member->fill(['user_id' => $users[$i], 'community_id' => $community->id]);
                $member->save();
            } 
        }
        return redirect()->route('chat.show', ['communityWithTrashed' => $community]);
    }
}
