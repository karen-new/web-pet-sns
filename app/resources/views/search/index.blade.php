@extends('layouts.app')

@section('content')

    <form class="text-center mb-5" action="{{ route('search') }}" method="GET">
        @csrf
        <i class="fa fa-search" aria-hidden="true"></i>
        <input type="text" name="keyword" value="{{ $keyword }}">
        <input type="submit" value="検索">
    </form>

    @forelse ($posts as $post)
    <tr>
        @include('layouts.post',['pet' => $post, 'pet_user' => $post->user, 'user' => $user])
    </tr>
    @empty
        <td>No Post</td>
    @endforelse

@endsection