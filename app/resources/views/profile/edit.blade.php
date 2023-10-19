@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto m-5">
        <div class="card-body">
            <div class="pt-2">
                <p class="h3 border-bottom border-secondary pb-3">プロフィール編集</p>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="m-3">
                    <div>
                        <img src="{{ \Storage::url($user->picture) }}" width="25%">
                    </div>
                    <div>
                        <input type="file" name="image">
                    </div>
                    <div class="form-group pt-1">
                        <label for="name">ユーザー名</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group pt-2">
                        <label for="introduction">自己紹介</label>
                        <input type="text" name="introduction" id="introduction" value="{{ $user->introduction }}" class="form-control">
                        <span class="text-danger">{{ $errors->first('introduction') }}</span>
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success rounded-pill m-2">更新する</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
