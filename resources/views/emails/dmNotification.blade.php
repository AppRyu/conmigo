<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conmigoメッセージ通知</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            max-width: 600px;
            padding: 0 20px 5px;
            margin: 0 auto;
            color:#4b4f56;
        }
        img {
            max-width: 100%;
            height: auto;
            vertical-align: bottom;
        }
        .logo {
            color: #536dfe;
        }
        .block {
            border: 1px solid #e9ebee;
            border-radius: 5px;
            padding: 15px;
        }
        .user-name {
            font-size: 18px;
            font-weight: bold;
        }
        .reply-btn {
            display: inline-block;
            background-color: #536dfe;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            line-height: 1.3em;
            text-align: center;
            padding: 20px 56px;
        }
        .from-user__tit {
            display: flex;
            align-items: center;
        }
        .c-icon {
            height: auto;
            width: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 11px;
        }
        .u-txt-center {
            text-align: center;
        }
        .u-fw-bold {
            font-weight: bold;
        }
        .u-mb {
            margin-bottom: 16px;
        }
        .u-px-sm {
            padding: 0 3px;
        }
    </style>
</head>
<body>
    <h1 class="logo u-txt-center u-mb">Conmigo</h1>
    <p class="u-txt-center u-mb">こんにちは<span class="u-fw-bold u-px-sm">{{ $to_name }}</span>さん<br>
        <span class="u-fw-bold u-px-sm">{{ $from_name }}</span>さんから新着メッセージが届いています。
    </p>
    <div class="block u-mb">
        <div class="from-user__tit u-mb">
            @if($from_user_image)
            <p class="c-icon"><img src="{{ asset('/storage/img/'.$from_user_image) }}" alt="送信したユーザー画像"></p>
            @else
            <p class="c-icon"><img src="{{ asset('./img/default-icon.png') }}" alt=""></p>
            @endif
            <h2 class="user-name">{{ $from_name }}</h2>
        </div>
        <p class="message">{!! nl2br(e($body)) !!}</p>
    </div>
    <div class="u-txt-center">
        <a class="reply-btn" href="{{ 'https://appryu.net/message/show/'.$room_id }}">返信する</a>
    </div>
</body>
</html>
