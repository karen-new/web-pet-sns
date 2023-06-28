@extends('layouts.app')

@section('content')

    <div class="container">
            <h2 class="my-5 text-center header-green">profile</h2>

            <div class="row"> 
                <div class="col-md-2 mx-auto profile_picture">
                    <img src="{{ Storage::url($user->picture) }}" class="img-fluid">
                </div>
                <div class="col-md-2 fw-bold fs-4 d-flex align-items-center">{{ $user->name }}</div>   
                <div class="col-md-6 d-flex align-items-center">{{ $user->introduction }}</div> 
            </div>
            <div class="d-flex">
                <div class="col-md-2">フォロー数 {{ $user->follows()->get()->count() }}</div> 
                <div class="col-md-2">フォロワー数 {{ $user->followers()->get()->count() }}</div> 
            </div>
            </div>

        <div class="border-bottom" style="padding:20px;">
            @if($user==auth()->user())
                <a href="{{ route('profile.edit', auth()->user()->id) }}" class="text-right btn btn-orange">
                    <i class="fa-solid fa-pen pe-2"></i>プロフィール編集
                </a>
            @else
                @if(in_array($user->id,auth()->user()->follows()->pluck('id')->toArray()))
                    <a href="{{ route('profile.unfollow', $user->id) }}" class="text-right btn btn-blue">
                        フォロー中
                    </a>
                @else
                    <a href="{{ route('profile.follow', $user->id) }}" class="text-right btn btn-blue">
                        フォローする
                    </a>
                @endif
            @endif
        </div>

        <h2 class="my-5 text-center header-green">投稿一覧</h2>

        <div class="row">
            @forelse($posts as $post)
                @include('layouts.post',['post' => $post, 'post_user' => $post->user, 'user' => $user])
            @empty
                まだ投稿がありません
            @endforelse
            
        </div>
    </div>

@endsection