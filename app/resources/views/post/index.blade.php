@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="my-5 text-center header-green">投稿一覧</h2>

        <div class="row">
            @forelse($posts as $post)
                @include('layouts.post',['post' => $post, 'post_user' => $post->user, 'user' => $user])
            @empty
                <div class="text-center">まだ投稿がありません</div>
            @endforelse
        </div>
    </div>
@endsection