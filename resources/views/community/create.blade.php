@extends('layouts.app')

@section('title', 'コミュニティ作成')

@section('content')
    <form method="post" action="{{ route('community.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="community">コミュニティ名 <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="community" required>
            </div>
            <div class="form-group col-md-6">
                <label for="created_user">ホストユーザー</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" name="created_user" id="created_user" value="{{ Auth::user()->user_name }}" readonly>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start_time-input">開始時間 <span class="text-danger">*</span></label>
                <community-set-time-input :data='@json([
                                            "id"          => "start_time",
                                            "name"        => "start_time",
                                            "placeholder" => "開始時間を設定してください"
                                        ])'></community-set-time-input>
            </div>
            <div class="form-group col-md-6">
                <label for="end_time-input">終了時間 <span class="text-danger">*</span></label>
                <community-set-time-input :data='@json([
                                            "id"          => "end_time",
                                            "name"        => "end_time",
                                            "placeholder" => "終了時間を設定してください"
                                        ])'></community-set-time-input>
            </div>
        </div>
        <div class="form-group">
            <label for="detail">コミュニティ詳細 <span class="text-danger">*</span></label>
            <textarea type="text" class="form-control" name="detail" id="detail" required></textarea>
        </div>
        <div class="prof-btn">
            <button class="btn btn-primary">コミュニティを作成</button>
        </div>
    </form>
@endsection
