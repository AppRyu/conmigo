<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityAdminController extends Controller
{
    public function index(String $user_name) {
        $user = User::where('user_name', $user_name)->first();
        $communities = $user->communities()->where('created_user', $user->id)->get(['id','name', 'created_user', 'start', 'end']);
        return view('front.community.admin', ['communities' => $communities]);
    }
}
