<?php

namespace App\Http\Controllers\Ajax;

use App\Message;
use App\Events\MessagePusher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $room_id = $request->room_id;
        // 新着順にメッセージ一覧を取得
        return Message::where('room_id', $room_id)->orderBy('id', 'asc')->get();
    }

    public function create(Request $request)
    {
        // メッセージを登録
        $message = Message::create([
            'body' => $request->message,
            'room_id' => $request->chat_room_id,
            'user_id' => $request->user_id,
        ]);

        event(new MessagePusher($message));
    }
}
