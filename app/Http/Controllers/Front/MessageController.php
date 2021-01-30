<?php

namespace App\Http\Controllers\Front;

use App\Message;
use App\Room;
use App\UserRoom;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    public function index() 
    {
        return view('front.message.index');
    }

    public function show(User $user)
    {

        $matching_user_id = $user->id;

        // 自分の持っているチャットルームを取得
        $current_user_chat_rooms = UserRoom::where('user_id', Auth::id())->pluck('room_id');


        // 自分の持っているチャットルームからチャット相手のいるルームを探す
        $chat_room_id = UserRoom::whereIn('room_id', $current_user_chat_rooms)->where('user_id', $matching_user_id)->pluck('room_id');


        // なければ作成する
        if ($chat_room_id->isEmpty()) {

            Room::create();

            // 最新チャットルームを取得
            $last_chat_room = Room::orderBy('created_at', 'desc')->first();

            $chat_room_id = $last_chat_room->id;

            // 新規登録 モデル側 $fillableで許可したフィールドを指定して保存
            UserRoom::create([
                'user_id' => Auth::id(),
                'room_id' => $chat_room_id,
            ]);

            UserRoom::create([
                'user_id' => $matching_user_id,
                'room_id' => $chat_room_id,
            ]);
        }

        // チャットルーム取得時はオブジェクト型なので数値に変換
        if(is_object($chat_room_id))
        {
            $chat_room_id = $chat_room_id->first();
        }

        // チャット相手のユーザー情報を取得
        $chat_room_user = User::findOrFail($matching_user_id);

        // チャット相手のユーザー名を取得（JS用）
        $chat_room_user_name = $chat_room_user->name;

        $chat_messages = Message::where('room_id', $chat_room_id)->orderby('created_at')->get();

        return view('front.message.show', [
                                            'matching_user' => $user,
                                            'matching_user_id' => $matching_user_id,
                                            'chat_room_id' => $chat_room_id, 
                                            'chat_room_user' => $chat_room_user, 
                                            'chat_messages' => $chat_messages, 
                                            'chat_room_user_name' => $chat_room_user_name
                                            ]);
        }

}
