@extends('layouts.app')

@section('title', 'コミュニティ作成')

@section('content')
    <h2 class="page-tit u-mb-xl"><i class="far fa-plus-square u-mr-base"></i>コミュニティを作成
    <div class="u-fs-sm u-mt-xs">あなたがホストとなってコミュニティを作成してください。</div>
    </h2>
    <form method="post" action="{{ route('community.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-12">
                <label for="community">コミュニティ名 <span class="text-danger mr-3">*</span>@error('name')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
                <input type="text" class="form-control" name="name" id="community" value="{{ old('name') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start-input">開始日時 <span class="text-danger mr-3">*</span>@error('start')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
                <community-set-time-input :data='@json([
                                            "id"          => "start",
                                            "name"        => "start",
                                            "placeholder" => "開始日時を設定してください"
                                        ])'></community-set-time-input>
            </div>
            <div class="form-group col-md-6">
                <label for="end-input">終了日時 <span class="text-danger mr-3">*</span>@error('end')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
                <community-set-time-input :data='@json([
                                            "id"          => "end",
                                            "name"        => "end",
                                            "placeholder" => "終了日時を設定してください"
                                        ])'></community-set-time-input>
            </div>
        </div>
        <div class="form-group">
            <label for="detail">コミュニティ詳細 <span class="text-danger mr-3">*</span>@error('detail')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
            <textarea type="text" class="form-control" name="detail" id="detail" required>{{ old('detail') }}</textarea>
        </div>
        <div class="prof-btn">
            <button class="btn btn-primary">コミュニティを作成</button>
        </div>
    </form>
@endsection
