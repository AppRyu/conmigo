<?php

namespace App\Http\Controllers\Front;

use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(Int $community_id) 
    {
        return view('front.chat.show');
    }
}
