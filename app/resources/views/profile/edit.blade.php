@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto m-5">
        <div class="card-body">
            <div class="pt-2">
                <p class="h3 border-bottom border-secondary pb-3">プロフィール編集</p>
            </div>
            {{ Form::open(['url' => route('profile.update', $user->id),  'method' => 'put', 'enctype' => 'multipart/form-data']) }}
            @csrf
            {{ Form::hidden('id',$user->id) }}
            <div class="m-3">
                <div>
                    <img src="{{ \Storage::url($user->picture) }}" width="25%">
                </div>
                <div>
                    <input type="file" name="image">
                </div>
                <div class="form-group pt-1">
                    {{Form::label('name','ユーザー名')}}
                    {{Form::text('name', $user->name, ['class' => 'form-control', 'id' =>'name'])}}
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group pt-2">
                    {{Form::label('introduction','自己紹介')}}
                    {{Form::text('introduction', $user->introduction, ['class' => 'form-control', 'id' =>'introduction'])}}
                    <span class="text-danger">{{$errors->first('introduction')}}</span>
                </div>
                <div class="form-group pull-right">
                    {{Form::submit(' 更新する ', ['class'=>'btn btn-success rounded-pill'])}}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
