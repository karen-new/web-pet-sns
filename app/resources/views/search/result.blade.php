@extends('layouts.app')

@section('content')

    <form class="text-center" action="{{ route('search') }}" method="GET">
        <i class="fa fa-search" aria-hidden="true"></i>
        <input type="text" name="keyword" value="{{ $keyword }}">
        <input type="submit" value="検索">
    </form>

    @forelse ($posts as $post)
    <tr>
        @include('layouts.post',['pet' => $post, 'user' => $user]);
    </tr>
    @empty
        <td>No posts!!</td>
    @endforelse

@endsection