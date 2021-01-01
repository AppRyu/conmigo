<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Community;
use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityPlanedController extends Controller
{
    public function index(String $user_name) {
        $user = User::where('user_name', $user_name)->first();
        $communities = $user->communities()->where('created_user', $user->id)->get(['id','name', 'created_user', 'start', 'end']);
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
        return redirect()->route('chat.show', ['community_id' => $community->id]);
    }
}
