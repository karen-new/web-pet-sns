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
            <a href="#followingModal" class="col-md-2" data-bs-toggle="modal">
                フォロー {{ $user->follows()->get()->count() }}
            </a>
            <a href="#followersModal" class="col-md-2" data-bs-toggle="modal">
                フォロワー {{ $user->followers()->get()->count() }}
            </a>
        </div>

        <!-- フォロー中モーダル -->
        <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- モーダルのコンテンツを表示するための場所 -->
                    <div class="modal-body" id="followingModalContent">
                        <!-- ここにフォローしている人の一覧を表示 -->
                        <h3>フォロー</h3>
                        <ul>
                            @php
                                $followedUsers = $user->follows()->get()
                            @endphp
                            @forelse ($followedUsers as $followedUser)
                                <a href="{{ route('profile.index', $followedUser->id) }}" class="mt-5">
                                    {{ $followedUser->name }}
                                </a>
                            @empty
                                nothing
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- フォロワーモーダル -->
        <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="followersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- モーダルのコンテンツを表示するための場所 -->
                    <div class="modal-body" id="followersModalContent">
                        <!-- ここにフォロワーの一覧を表示 -->
                        <h3>フォロワー</h3>
                        <ul>
                            @php
                                $followers = $user->followers()->get()
                            @endphp
                            @forelse ($followers as $follower)
                            <a href="{{ route('profile.index', $follower->id) }}" class="mt-5">
                                {{ $follower->name }}
                            </a>
                            @empty
                                nothing
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-bottom" style="padding:20px;">
            @if($user==auth()->user())
                <a href="{{ route('profile.edit') }}" class="text-right btn btn-orange">
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
