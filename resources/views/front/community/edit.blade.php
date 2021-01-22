@extends('layouts.app')

@section('title', 'コミュニティ編集')

@section('content')
<section>
    <h2 class="page-tit u-mb-xl"><i class="far fa-edit u-mr-base"></i>コミュニティ編集</h2>
    <form method="post" action="{{ route('community.update', ['community' => $community]) }}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-12">
                <label class="u-mb-sm" for="community">コミュニティ名<span class="text-danger u-mx-xs">*</span>@error('name')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
                <input type="text" class="form-control" name="name" id="community" value="{{ old('name') ? old('name') : $community->name }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="u-mb-sm" for="start-input">開始日時<span class="text-danger u-mx-xs">*</span>@error('start')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
                <community-set-time-input :data='@json([
                                            "id"          => "start",
                                            "name"        => "start",
                                            "placeholder" => "開始日時を設定してください"
                                        ])'
                                        :initial-start-date-time='@json($community->start)'
                                        ></community-set-time-input>
            </div>
            <div class="form-group col-md-6">
                <label class="u-mb-sm" for="end-input">終了日時<span class="text-danger u-mx-xs">*</span>@error('end')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
                <community-set-time-input :data='@json([
                                            "id"          => "end",
                                            "name"        => "end",
                                            "placeholder" => "終了日時を設定してください"
                                        ])'
                                        :initial-end-date-time='@json($community->end)'
                                        ></community-set-time-input>
            </div>
        </div>
        <div class="form-group">
            <label class="u-mb-sm" for="detail">コミュニティ詳細<span class="text-danger u-mx-xs">*</span>@error('detail')<span class="d-inline-block text-danger">{{ $message }}</span>@enderror</label>
            <textarea type="text" class="form-control" name="detail" id="detail" required>{{ old('detail') ? old('detail') : $community->detail }}</textarea>
        </div>
        <div class="prof-btn">
            <button class="btn btn-primary">コミュニティ更新</button>
        </div>
    </form>
</section>
@endsection
