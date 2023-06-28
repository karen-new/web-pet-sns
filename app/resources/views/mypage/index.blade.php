@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="profile">
            <h2 class="my-5 text-center header-green">profile</h2>
            <div class="d-flex justify-content-center">
                <div class ="profile_picture">
                    <img src="{{ Storage::url($user->picture) }}">
                </div>
                <div class="d-flex flex-column bd-highlight mb-3">
                <div class="text-center">{{ $user->name }}</div>
                <div class="text-center">{{ $user->introduction }}</div>      
                <div class="text-center">フォロー数 {{ $user->follows()->get()->count() }}</div> 
                <div class="text-center">フォロワー数 {{ $user->followers()->get()->count() }}</div> 
            </div>

        </div>

        <div class="border-bottom" style="padding:20px;">
            @if($user==auth()->user())
                <a href="{{ route('mypage.edit', auth()->user()->id) }}" class="text-right btn btn-orange">
                    <i class="fa-solid fa-pen pe-2"></i>プロフィール編集
                </a>
            @else
                @if(in_array($user->id,auth()->user()->follows()->pluck('id')->toArray()))
                    <a href="{{ route('mypage.unfollow', $user->id) }}" class="text-right btn btn-blue">
                        フォロー中
                    </a>
                @else
                    <a href="{{ route('mypage.follow', $user->id) }}" class="text-right btn btn-blue">
                        フォローする
                    </a>
                @endif
            @endif
        </div>

        <h2 class="my-5 text-center header-green">投稿一覧</h2>

        <div class="row">
            @forelse($pets as $pet)
                @include('layouts.post',['pet' => $pet, 'pet_user' => $pet->user, 'user' => $user])
            @empty
                <td>No posts!!</td>
            @endforelse
            
        </div>
    </div>

@endsection