@extends('layouts.app')

@section('content')

    <form class="text-center mb-5" action="{{ route('search') }}" method="GET">
        @csrf
        <i class="fa fa-search" aria-hidden="true"></i>
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワードで検索">
        @include('layouts.animal_dropdown')
        <input type="text" name="tag" value="{{ $tag }}" placeholder="タグで検索">
        <input type="submit" value="検索">
    </form>

    @forelse ($posts as $post)
    <div>
        @include('layouts.post', ['post' => $post, 'post_user' => $post->user, 'user' => $user])
    </div>
    @empty
        <p class="text-center">一致する結果はありません</p>
    @endforelse
@endsection
