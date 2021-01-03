<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('front.chat.index');
    }

    public function show(Community $community) 
    {
        return view('front.chat.show', ['community' => $community]);
    }
}
