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
        // ゲストとして参加しているコミュニティIDを取得
        $allAppliedCommunityId = Member::where('user_id', auth()->user()->id)->pluck('community_id')->toArray();
        // ホストとして参加しているコミュニティIDを取得
        $allPlanedCommunityId = Community::withTrashed()->where('created_user', auth()->user()->id)->pluck('id')->toArray();
        // ゲスト・ホスト問わず、参加している全てのコミュニティIDを取得
        $allJoiningCommunityId = array_merge($allAppliedCommunityId, $allPlanedCommunityId);
        // 取得したコミュニティIDを参照して、対応するコミュニティデータを取得
        $communities = Community::withTrashed()->whereIn('id', $allJoiningCommunityId)->select('id', 'name', 'created_user', 'start', 'end')->orderBy('start')->paginate(15);
        return view('front.chat.index', ['communities' => $communities]);
    }

    public function show(Community $community) 
    {
        // コミュニティに参加しているメンバーを格納
        $members = [];
        // コミュニティに参加しているユーザーIDを取得(コミュニティを作成したユーザーIDは除く)
        $members = Member::where('community_id', $community->id)->pluck('user_id')->toArray();
        // 取得したユーザーIDを参照して、ユーザーデータを取得(コミュニティを作成したユーザーは除く)
        $usersWithoutCreatedUser = User::withTrashed()->whereIn('id', $members)->select('user_name', 'profile_image')->get();
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
