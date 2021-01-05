<?php

namespace App\Http\Controllers\Front;

use App\Community;
use App\Member;
use App\User;
use App\CommunityMessages;
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
        // コミュニティに参加しているユーザーIDを取得(コミュニティを作成したユーザーIDは除く)
        $members = Member::where('community_id', $community->id)->pluck('user_id')->toArray();
        $usersWithoutCreatedUser = User::whereIn('id', $members)->select('user_name', 'profile_image')->get();
        // コミュニティを作成したユーザーIDを追加
        $members[] = $community->created_user;
        // ログインユーザーがコミュニティメンバーである場合
        if(in_array(auth()->user()->id, $members)) {
            $chats = CommunityMessages::where('community_id', $community->id)->select('user_id', 'message', 'created_at')->get();
            return view('front.chat.show', ['community' => $community, 'chats' => $chats, 'usersWithoutCreatedUser' => $usersWithoutCreatedUser]);
        } else {
            return redirect()->route('chat.index');
        }
    }

    public function sendMessage(Request $request, Community $community) 
    {
        $communityMessage = new CommunityMessages();
        $communityMessage->fill(['user_id' => auth()->user()->id, 'community_id' => $community->id, 'message' => $request->message]);
        $communityMessage->save();
        return redirect()->route('chat.show', ['community' => $community]);
    }
}
