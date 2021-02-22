<?php

namespace App\Http\Controllers\Ajax;

use App\Message;
use App\User;
use App\Events\MessagePusher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Auth;

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
        // メッセージをデータベースに登録
        $message = Message::create([
            'body' => $request->message,
            'room_id' => $request->chat_room_id,
            'user_id' => $request->user_id, // ログインユーザーID
        ]);

        // メッセージ非同期送信
        event(new MessagePusher($message));

        // 送信メールに必要な情報を格納
        $data = [
            'from_name' => Auth::user()->name,
            'from_user_image' => Auth::user()->profile_image,
            'to_name' => $request->to_user_name,
            'to_email' => $request->to_user_email,
            'room_id' => $request->chat_room_id,
            'body' => $request->message,
        ];

        // メールへ通知
        Mail::send('emails.dmNotification', $data, function($message) use ($data) {
            $message->from('info@appryu.net', 'Conmigo')
                    ->to($data['to_email'], $data['to_name'])
                    ->subject($data['to_name'].'さんから新着メッセージがあります。');
        });
    }
}
