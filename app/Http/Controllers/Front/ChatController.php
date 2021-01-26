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
        $communityStatus = '';
        // 論理削除されているか判定
        if(!is_null($community->deleted_at)) {
            $communityStatus = 'deleted';
        }
        // メンバーを確定しているか判定
        elseif(!$community->members->count()) {
            $communityStatus = 'noMember';
        }
        // メッセージが存在するか判定
        elseif(!$community->communityMessages->count()) {
            $communityStatus = 'noMsg';
        }
        // コミュニティに参加しているメンバーを格納
        $members = [];
        // コミュニティに参加しているユーザーIDを取得(コミュニティを作成したユーザーIDは取得されない)
        $members = Member::where('community_id', $community->id)->pluck('user_id')->toArray();
        // コミュニティを作成したユーザーIDを追加
        $members[] = $community->created_user;
        // 取得したユーザーIDを参照して、コミュニティメンバー全員のデータを取得
        $AllCommunityMember = User::withTrashed()->whereIn('id', $members)->select('id', 'user_name', 'profile_image', 'last_login_at')->get();
        // ログインユーザーがコミュニティメンバーである場合
        if(in_array(auth()->user()->id, $members)) {
            $chats = CommunityMessages::where('community_id', $community->id)->select('user_id', 'message', 'created_at')->get();
            return view('front.chat.show', ['community' => $community, 'communityStatus' => $communityStatus, 'chats' => $chats, 'AllCommunityMember' => $AllCommunityMember]);
        } else {
            return redirect()->route('chat.index');
        }
    }

    public function sendMessage(Request $request, Community $community) 
    {
        $communityMessage = new CommunityMessages();
        $communityMessage->fill(['user_id' => auth()->user()->id, 'community_id' => $community->id, 'message' => $request->message]);
        $communityMessage->save();
        return redirect()->route('chat.show', ['communityWithTrashed' => $community]);
    }
}
